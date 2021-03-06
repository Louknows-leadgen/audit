<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Rules\CallIsClaimed;
use App\Models\CallLog;
use App\Models\CallLogArchive;
use App\Models\Script;
use App\Models\ScriptResponse;
use App\Models\AgentScriptResponse;
use App\Models\ExternalScriptResponse;
use App\Models\UserEmployeeMapping;


class AuditorController extends Controller
{
	public function __construct(){
		$this->middleware('checkrole:4');
	}

    //
    public function index(){
    	$calllogs = CallLog::team_available_logs(Auth::id());

		return view('auditor.available_logs',compact('calllogs'));
    }

    public function team_claimed_logs(){
    	$calllogs = CallLog::team_claimed_logs(Auth::id());

    	return view('auditor.team_claimed_logs',compact('calllogs'));
    }

    public function my_call_logs(){
    	$calllogs = CallLog::my_call_logs(Auth::id());
    	$scripts = Script::all();

    	return view('auditor.my_call_logs',compact('calllogs','scripts'));
    }
   

    public function recording($recording_id){
        $calllog = CallLog::where('recording_id','=',$recording_id)->first();
        if(empty($calllog)){
            $calllog = CallLogArchive::where('recording_id','=',$recording_id)->first();
        }
        // $server = $calllog->server_ip;
        $user_id = $calllog->user;
        $emp = UserEmployeeMapping::firstWhere('user_id',$user_id);
        $recording_files = $this->generate_recording_url($calllog);

        return view('auditor.recording',compact('emp','user_id','recording_id','recording_files'));
    }

    public function result($recording_id){
        $calllog = CallLog::where('recording_id','=',$recording_id)->first();
        if(empty($calllog)){
            $calllog = CallLogArchive::where('recording_id','=',$recording_id)->first();
        }
    }


    private function generate_recording_url($calllog){
        $urls = [];
        $filename = $calllog->recording_filename;
        $server = $calllog->server_origin;
        $date = date('Y-m-d',strtotime($calllog->timestamp));

        array_push($urls, ['type' => 'wav', 'url' => "http://$server/RECORDINGS/$filename-all.wav"]);
        array_push($urls, ['type' => 'mpeg', 'url' => "http://$server/RECORDINGS/MP3/$filename-all.mp3"]);
        array_push($urls, ['type' => 'mpeg', 'url' => "http://$server/archive/$date/$filename-all.mp3"]);

        return $urls;
    }


    public function claim_call(Request $request){
    	$validator = Validator::make($request->all(),[
    		'call_id' => ['required', new CallIsClaimed]
    	]);

    	if($validator->fails()){
            return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }else{
            $call_id = $request->call_id;
            $c = CallLog::find($call_id);
            if(empty($c)){
                $c = CallLogArchive::find($call_id);
            }
            $c->is_claimed = 1;
            $c->claimed_by = Auth::id();
            $c->save();
            return response()->json(['success'=>'Successfully claimed the call log']);
        }
    }

    public function bulk_claim(Request $request){
    	$validator = Validator::make($request->all(),[
            'calllogs' => 'required'
        ],[
            'calllogs.required' => 'No selected call logs'
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }else{
        	$calllogs = $request->calllogs;
        	$auditor = Auth::id();
        	CallLog::bulk_claim($auditor,$calllogs);
        	return response()->json(['success'=>'Claimed selected call logs']);
        }
    }

    public function submit_audit(Request $request){
        $recording_id = $request->recording_id;

        foreach ($request->responses as $response) {
            if($this->is_not_empty($response)){
                $scrpt_resp = ScriptResponse::firstOrNew(['recording_id'=>$recording_id,'script_id'=>$response['id']]);
                $scrpt_resp->cust_statement = isset($response['cust_statement']) ? $response['cust_statement'] : null;
                $scrpt_resp->aud_comment = isset($response['aud_comment']) ? $response['aud_comment'] : null;
                $scrpt_resp->inc_tagging = isset($response['inc_tagging']) ? $response['inc_tagging'] : null;
                $scrpt_resp->inapp_resp = isset($response['inapp_resp']) ? $response['inapp_resp'] : null;
                $scrpt_resp->inc_detail = isset($response['inc_detail']) ? $response['inc_detail'] : null;

                if($scrpt_resp->save()){
                    if(isset($response['agent_correction'])){
                        // remove records that are no longer selected
                        AgentScriptResponse::delete_if_not_exist($scrpt_resp->id,$response['agent_correction']);

                        // insert only if the record does not exist
                        foreach ($response['agent_correction'] as $agent_correction_id) {
                            $agent_script_response = ['script_response_id' => $scrpt_resp->id,'agent_correction_id' => $agent_correction_id];
                            AgentScriptResponse::firstOrCreate($agent_script_response);
                        }
                    }

                    if(isset($response['external_factor'])){
                        // remove records that are no longer selected
                        ExternalScriptResponse::delete_if_not_exist($scrpt_resp->id,$response['external_factor']);

                        // insert only if the record does not exist
                        foreach ($response['external_factor'] as $external_factor_id) {
                            $external_script_response = ['script_response_id' => $scrpt_resp->id,'external_factor_id' => $external_factor_id];
                            ExternalScriptResponse::firstOrCreate($external_script_response);
                        }
                    }
                }
            }
        }
        // update calllog status
        $clog = CallLog::findby_recording_id($recording_id);
        $clog->status = 1;
        $clog->save();
        return redirect()->route('auditor.my_call_logs')->with('success','Audit recorded');
    }

    private function is_not_empty($response){
        $ret = false;

        if(isset($response['cust_statement']) || isset($response['aud_comment']) || isset($response['inc_tagging']) || isset($response['inapp_resp']) || isset($response['inc_detail']) || isset($response['agent_correction']) || isset($response['external_factor'])){
            $ret = true;
        }

        return $ret;
    }

}
