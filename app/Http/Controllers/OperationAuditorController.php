<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\CallLogsAssigned;
use App\Models\CallLogArchive;
use App\Models\UserEmployeeMapping;
use App\Models\OpsScriptResponse;


class OperationAuditorController extends Controller
{
	public function __construct(){
		$this->middleware('checkrole:5');
	}

  
    public function index(){
        return view('ops_auditor.index');
    }
    

    //
    public function audited_list(){
    	$calllogs = CallLogsAssigned::audited_logs();

		return view('ops_auditor.audited-list',compact('calllogs'));
    }


    public function audited($recording_id){
        $calllog = CallLogsAssigned::where('recording_id','=',$recording_id)->first();

        // $server = $calllog->server_ip;
        $user_id = $calllog->user;
        $audit_type = $calllog->audit_type;
        $emp = UserEmployeeMapping::firstWhere('user_id',$user_id);
        $recording_file = ['type' => $this->get_filetype($calllog->recording_url), 'url' => $calllog->recording_url];

        return view('ops_auditor.audited',compact('calllog','emp','user_id','recording_file','audit_type'));
    }


    public function op_search_call(Request $request){
        $searchtxt = $request->searchtxt;
        $searchtype = $request->searchtype;

        if($searchtype == 1){
            $call = CallLogArchive::search_by_phone($searchtxt);
        }else{
            $call = CallLogArchive::search_by_recording_id($searchtxt);
        }

        return view('ops_auditor._search-result',compact('call'));
    }


    public function recording($ctr){
        $calllog = CallLogArchive::search_by_id($ctr);

        // $server = $calllog->server_ip;
        $user_id = $calllog->user;
        $audit_type = $calllog->audit_type;
        $emp = UserEmployeeMapping::firstWhere('user_id',$user_id);
        // $recording_file = ['type' => 'wav', 'url' => $calllog->recording_url];
        $recording_file = $this->generate_recording_url($calllog);
        
        return view('ops_auditor.recording',compact('calllog','emp','user_id','recording_file','audit_type'));
    }


    public function submit_audit(Request $request){
        $ctr = $request->ctr;

        date_default_timezone_set('Asia/Kuala_Lumpur');
        $audit_end = date('Y-m-d H:i:s');

        foreach ($request->responses as $response) {
            if($this->is_not_empty($response)){
                $scrpt_resp = OpsScriptResponse::firstOrNew(['ctr'=>$ctr,'script_id'=>$response['id']]);
                $scrpt_resp->cust_statement = isset($response['cust_statement']) ? $response['cust_statement'] : null;
                $scrpt_resp->aud_comment = isset($response['aud_comment']) ? $response['aud_comment'] : null;
                $scrpt_resp->inc_tagging = isset($response['inc_tagging']) ? $response['inc_tagging'] : null;
                $scrpt_resp->inapp_resp = isset($response['inapp_resp']) ? $response['inapp_resp'] : null;
                $scrpt_resp->inc_detail = isset($response['inc_detail']) ? $response['inc_detail'] : null;

                if($scrpt_resp->save()){
                    if(isset($response['agent_correction'])){
                        // remove records that are no longer selected
                        OpsAgentScriptResponse::delete_if_not_exist($scrpt_resp->id,$response['agent_correction']);

                        // insert only if the record does not exist
                        foreach ($response['agent_correction'] as $agent_correction_id) {
                            $agent_script_response = ['ops_script_response_id' => $scrpt_resp->id,'agent_correction_id' => $agent_correction_id];
                            OpsAgentScriptResponse::firstOrCreate($agent_script_response);
                        }
                    }

                    if(isset($response['external_factor'])){
                        // remove records that are no longer selected
                        OpsExternalScriptResponse::delete_if_not_exist($scrpt_resp->id,$response['external_factor']);

                        // insert only if the record does not exist
                        foreach ($response['external_factor'] as $external_factor_id) {
                            $external_script_response = ['script_response_id' => $scrpt_resp->id,'external_factor_id' => $external_factor_id];
                            OpsExternalScriptResponse::firstOrCreate($external_script_response);
                        }
                    }
                }
            }
        }
        // update calllog status
        $clog = CallLogsAssigned::findby_recording_id($recording_id);
        $clog->status = 1;
        $clog->audit_start = $request->audit_start;
        $clog->audit_end = $audit_end;
        $clog->save();
        return redirect()->route('auditor.my_call_logs')->with('success','Audit recorded');
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


    private function get_filetype($url){
        if(stripos($url, '.mp3')){
            return 'mpeg';
        }

        return 'wav';
    }
}
