<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\CallLogsAssigned;
use App\Models\CallLogArchive;
use App\Models\OperationCallAudits;
use App\Models\UserEmployeeMapping;
use App\Models\OpsScriptResponse;
use App\Models\OpsAgentScriptResponse;
use App\Models\OpsExternalScriptResponse;
use App\Models\User;


class OperationAuditorController extends Controller
{
	public function __construct(){
		$this->middleware('checkrole:5');
	}

    //
    public function index(){
    	$calllogs = CallLogsAssigned::audited_logs();
        $auditors = User::where('role_id',4)->get(); // auditors role list
        
		return view('ops_auditor.index',compact('calllogs', 'auditors'));
    }

    /* 
        url: /operation/audited/{recording}
        description: display the call details audited by the qa auditor
    */
    public function audited($recording_id){
        $calllog = CallLogsAssigned::where('recording_id','=',$recording_id)->first();
        $ops_id = Auth::id(); 

        $user_id = $calllog->user;
        $audit_type = $calllog->audit_type;
        $emp = UserEmployeeMapping::firstWhere('user_id',$user_id);
        $recording = $this->generate_recording_url($calllog);
        $is_audited = OperationCallAudits::IsNotAudited($calllog->ctr,$ops_id)->get()->count() > 0 ? true : false;
        if(!empty($recording)){
            $recording_file = $recording;
        }else{
            $recording_file = ['type' => 'wav', 'url' => $calllog->recording_url];
        }

        return view('ops_auditor.audited',compact('calllog','emp','user_id','recording_file','audit_type','is_audited','ops_id'));
    }


    public function search(Request $request){
        $searchtxt = $request->searchtxt;
        $searchtype = $request->type;
        $auditors = User::where('role_id',4)->get(); // auditors role list

        switch ($request->type) {
            case 'record_id':
                // recording id scope
                $calls = CallLogsAssigned::whereLikeCompleted('recording_id',$searchtxt)->paginate(10);
                break; 
            case 'recording_date':
                // recording id scope
                if(!isset($searchtxt)){
                    $searchtxt = date('Y-m-d');
                }
                $calls = CallLogsAssigned::whereDateEqualCompleted('timestamp',$searchtxt)->paginate(10);  
                break; 
            case 'agent_id':
                // recording id scope
                $calls = CallLogsAssigned::whereLikeCompleted('user',$searchtxt)->paginate(10);  
                break;  
            case 'phone':
                // recording id scope
                $calls = CallLogsAssigned::whereLikeCompleted('phone_number',$searchtxt)->paginate(10);  
                break;   
            case 'auditor':
                // recording id scope
                $calls = CallLogsAssigned::where('claimed_by',$searchtxt)->paginate(10);  
                break;        
            default:
                # code...
                break;
        }

         return view('ops_auditor.search',compact('calls','searchtxt','searchtype', 'auditors'));
    }



    private function get_filetype($url){
        if(stripos($url, '.mp3')){
            return 'mpeg';
        }

        return 'wav';
    }

    private function generate_recording_url($calllog){
        $urls = [];
        $filename = $calllog->recording_filename;
        $server = $calllog->server_origin;
        $date = date('Y-m-d',strtotime($calllog->timestamp));

        array_push($urls, ['type' => 'wav', 'url' => "http://$server/RECORDINGS/$filename-all.wav"]);
        array_push($urls, ['type' => 'mpeg', 'url' => "http://$server/RECORDINGS/MP3/$filename-all.mp3"]);
        array_push($urls, ['type' => 'mpeg', 'url' => "http://38.102.225.164/archive/$date/$filename-all.mp3"]);

        $url = [];
        foreach ($urls as $endpoint) {
            $response = $this->check_url($endpoint['url']);
            if($response == '200'){
                $url = $endpoint;
                break;
            }
        }

        return $url;
    }

    private function check_url($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        $headers = curl_getinfo($ch);
        curl_close($ch);

        return $headers['http_code'];
    }


    /* 
        url: /operation/recordings/{ops_user}/{ctr}
        description: display the call details to be audited by the ops auditor
    */
    public function recording($ops_user, $ctr){
        $calllog = CallLogsAssigned::where('ctr','=',$ctr)->first();
        if(empty($calllog)){
            $calllog = CallLogArchive::where('ctr','=',$ctr)->first();
        }

        $recording_id = $calllog->recording_id;
        $user_id = $calllog->user;
        $audit_type = $calllog->audit_type;
        $emp = UserEmployeeMapping::firstWhere('user_id',$user_id);

        $recording = $this->generate_recording_url($calllog);
        if(!empty($recording)){
            $recording_file = $recording;
        }else{
            $recording_file = ['type' => 'wav', 'url' => $calllog->recording_url];
        }
        
        return view('ops_auditor.recording',compact('calllog','emp','user_id','recording_id','recording_file','audit_type', 'ops_user'));
    }


    /* 
        url: /operation/submit_audit/{ops_user}
        description: display the call details to be audited by the ops auditor
    */
    public function submit_audit(Request $request){
        $call = OperationCallAudits::insertToOperationCallAudits($request->calllog);

        if(!empty($call)){
            foreach ($request->responses as $response) {
                if($this->is_not_empty($response)){
                    $scrpt_resp = OpsScriptResponse::firstOrNew(['recording_id'=>$call->recording_id,'script_id'=>$response['id']]);
                    $scrpt_resp->cust_statement = isset($response['cust_statement']) ? $response['cust_statement'] : null;
                    $scrpt_resp->aud_comment = isset($response['aud_comment']) ? $response['aud_comment'] : null;
                    $scrpt_resp->inc_tagging = isset($response['inc_tagging']) ? $response['inc_tagging'] : null;
                    $scrpt_resp->inapp_resp = isset($response['inapp_resp']) ? $response['inapp_resp'] : null;
                    $scrpt_resp->inc_detail = isset($response['inc_detail']) ? $response['inc_detail'] : null;

                    if($scrpt_resp->save()){
                        if(isset($response['agent_correction'])){
                            // insert only if the record does not exist
                            foreach ($response['agent_correction'] as $agent_correction_id) {
                                $agent_script_response = ['ops_script_response_id' => $scrpt_resp->id,'agent_correction_id' => $agent_correction_id];
                                OpsAgentScriptResponse::firstOrCreate($agent_script_response);
                            }
                        }

                        if(isset($response['external_factor'])){
                            // insert only if the record does not exist
                            foreach ($response['external_factor'] as $external_factor_id) {
                                $external_script_response = ['ops_script_response_id' => $scrpt_resp->id,'external_factor_id' => $external_factor_id];
                                OpsExternalScriptResponse::firstOrCreate($external_script_response);
                            }
                        }
                    }
                }
            }
        }

        return redirect()->route('ops.my_audits')->with('success','Audit recorded');

    }


    public function my_audits(){
        $calllogs = OperationCallAudits::myAudits(Auth::id())->paginate(10);
        // $scripts = Script::all();

        return view('ops_auditor.my_audits',compact('calllogs'));
    }


     private function is_not_empty($response){
        $ret = false;

        if(isset($response['cust_statement']) || isset($response['aud_comment']) || isset($response['inc_tagging']) || isset($response['inapp_resp']) || isset($response['inc_detail']) || isset($response['agent_correction']) || isset($response['external_factor'])){
            $ret = true;
        }

        return $ret;
    }

}
