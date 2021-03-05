<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\CallLogResponses;
use App\Models\ScriptResponse;


class DownloadController extends Controller
{
    //
    function downloadCallLogResponses(Request $request){
    	$headings = [
    		'Recording ID',
    		'User',
    		'User Group',
    		'Phone Number',
    		'Server',
    		'Campaign',
    		'Dispo',
    		'Talk Time',
    		'Script',
    		'Customer Statement',
    		'Auditor\'s Comment',
    		'Agent\'s Correction',
    		'Incorrect Tagging',
    		'Inapproriate Response',
    		'Incorrect Details',
    		'External Factors'
    	];

    	$from = $request->from;
    	$to = $request->to;

    	$calllog_responses = ScriptResponse::call_responses($from, $to);

    	return (new CallLogResponses($headings,$calllog_responses))->download('calllogs.xlsx');
    }
}


