<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Rules\CallIsClaimed;
use App\Models\CallLog;
use App\Models\Script;
use App\Models\RecordingScript;


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

    public function claim_call(Request $request){
    	$validator = Validator::make($request->all(),[
    		'call_id' => ['required', new CallIsClaimed]
    	]);

    	if($validator->fails()){
            return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }else{
            $call_id = $request->call_id;
            $c = CallLog::find($call_id);
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
        // foreach($request->all() as $script_resp){
           
        //     if($this->is_not_empty($script_resp) && 
        //        RecordingScript::is_uniq_response($script_resp['script_code'],$script_resp['recording_id'])){

        //         $recording_script = new RecordingScript;
        //         $recording_script->script_code = $script_resp['script_code'];
        //         $recording_script->recording_id = $script_resp['recording_id'];
        //         $recording_script->cust_statement = $script_resp['cust_statement'];
        //         $recording_script->acknowledgement = isset($script_resp['acknowledge']) ? $script_resp['acknowledge'] : null;
        //         $recording_script->agent_resp = $script_resp['agent_response'];
        //         $recording_script->agent_resp_spd = $script_resp['agent_response_speed'];
        //         $recording_script->cust_dtl = $script_resp['customer_details'];
        //         $recording_script->agent_input = $script_resp['agent_input'];
        //         $recording_script->comment = $script_resp['comment'];

        //         $recording_script->save();

        //     }
        // }

        // return response()->json(['success'=>'Success']);
        return view('auditor.findings_forms.index');
    }

    public function is_not_empty($params){
            return isset($params['cust_statement']) ||
                   isset($params['acknowledge'])||
                   isset($params['agent_response']) ||
                   isset($params['agent_response_speed']) ||
                   isset($params['customer_details']) ||
                   isset($params['agent_input']) ||
                   isset($params['comment']);
    }
}
