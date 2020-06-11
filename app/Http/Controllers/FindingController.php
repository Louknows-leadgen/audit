<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Finding;

class FindingController extends Controller
{
    //
    public function store(Request $request){
    	$finding = new Finding;
    	$finding->recording_id = $request->recording_id;
    	$finding->agent_dispo = $request->agent_dispo;
    	$finding->correct_dispo = $request->correct_dispo;
    	$finding->agnt_sys_issue = $request->agnt_sys_issue;
    	$finding->zt_lol = $request->zt_lol;
    	$finding->gen_obsrv = $request->gen_obsrv;
    	$finding->qa_remarks = $request->qa_remarks;

    	if($finding->save()){
    		$call_log = $finding->call_log;
    		$call_log->status = 1;
    		$call_log->save();
    		return redirect()->route('auditor.my_call_logs')->with('success','Audit recorded');
    	}else{
    		return redirect()->route('auditor.my_call_logs')->with('failed','Failed to record the audit');
    	}
    }
}
