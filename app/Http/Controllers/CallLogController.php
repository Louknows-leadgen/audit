<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CallLog;
use App\Models\CallLogArchive;

class CallLogController extends Controller
{
    //
    public function audited_by_agents(){
    	$agents = CallLog::agents_audited();

    	return view('call_log.audited_by_agents',compact('agents'));
    }

    // public function search_form(){
    // 	return view('call_log.search_page');
    // }

    public function search(Request $request){
    	$phone_number = $request->phone_number;
    	
        $calllog = [];
        if(!empty($phone_number)){
            $calllog = CallLog::where('phone_number',$phone_number)->first();
        	if(empty($calllog)){
        		$calllog = CallLogArchive::where('phone_number',$phone_number)->first();
        	}
        }

    	return view('call_log.search_page',compact('calllog','phone_number'));
    }

    public function tag_call(Request $request){
        $audit_type = $request->audit_type;
        $ctr = $request->ctr;

        $call = CallLog::find($ctr);
        if(empty($call)){
            $call = CallLogArchive::find($ctr);
        }

        if(!empty($call){
            $call->audit_type = $audit_type;
            $call->save;
        }
    }
}
