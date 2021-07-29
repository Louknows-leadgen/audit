<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CallLogsAssigned;
use App\Models\OperationCallAudits;

class CallLogController extends Controller
{
    //

    public function update_recording_url(Request $request){
    	$ctr = $request->ctr;
    	$url = $request->url;
    	$messages = [];

    	/* Update only tables that were used when calls are assigned */
    	
    	// Update CallLogsAssigned
    	$call_assigned = CallLogsAssigned::find($ctr);
    	if($call_assigned){
	    	$call_assigned->recording_url = $url;
	    	if($call_assigned->save()){
	    		array_push($messages,"Success: Updated CallLogs Assigned recording url");
	    	}
	    }

    	// Update OperationCallAudits
    	$ops_call = OperationCallAudits::where('ctr',$ctr)->first();
    	if($ops_call){
	    	$ops_call->recording_url = $url;
	    	if($ops_call->save()){
	    		array_push($messages,"Success: Updated Operation Call Audits recording url");
	    	}
	    }

    	return response()->json(['messages' => $messages]);
    }
}
