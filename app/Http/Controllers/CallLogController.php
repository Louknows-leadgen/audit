<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CallLog;

class CallLogController extends Controller
{
    //
    public function audited_by_agents(){
    	$agents = CallLog::agents_audited();

    	return view('call_log.audited_by_agents',compact('agents'));
    }
}
