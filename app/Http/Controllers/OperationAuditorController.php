<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\CallLogsAssigned;
use App\Models\UserEmployeeMapping;


class OperationAuditorController extends Controller
{
	public function __construct(){
		$this->middleware('checkrole:5');
	}

    //
    public function index(){
    	$calllogs = CallLogsAssigned::audited_logs();

		return view('ops_auditor.index',compact('calllogs'));
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

    private function get_filetype($url){
        if(stripos($url, '.mp3')){
            return 'mpeg';
        }

        return 'wav';
    }
}
