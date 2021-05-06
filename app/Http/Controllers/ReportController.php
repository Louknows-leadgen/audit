<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CallLogsAssigned;

class ReportController extends Controller
{
    //
    public function index(Request $request){
    	$user_role = $request->user()->role_id;
    	return view('report.index',compact('user_role'));
    }

    public function calllog_responses(){
    	return view('report.calllog-responses');
    }

    public function auditors_hourly(){
    	$auditors = User::where('role_id', 4)->get();
    	return view('report.auditors_hourly',compact('auditors'));
    }

    public function auditors_hourly_content(Request $request){
    	$auditor = $request->auditor;
    	$audit_dt = $request->audit_dt;

    	$date = date('F d, Y');
    	$rows = CallLogsAssigned::hourly_count($auditor, $audit_dt);

    	$hours = [];
    	foreach ($rows as $row) {
    		$hr = $this->append_hour_suffix($row->hr);
    		$ctr = $row->ctr;

    		array_push($hours, (object)['hr'=>$hr, 'ctr'=>$ctr]);
    	}

    	return view('report.partials.auditors_hourly_content',compact('date','hours'));
    }

    private function append_hour_suffix($hr){
    	$hour = (int) $hr;
    	if($hour < 12){
    		return str_pad($hr,2,"0",STR_PAD_LEFT) . ' AM';
    	}

    	return str_pad(($hr - 12),2,"0",STR_PAD_LEFT) . ' PM';
    }
}
