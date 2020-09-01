<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Finding;
use App\Models\FindingDisposition;
use App\Models\FindingIssue;
use App\Models\FindingZtpLol;

class FindingController extends Controller
{
    //

    public function store(Request $request){
        //dd($request->all());

        // insert findings record
        $finding = Finding::create(['recording_id'=>$request->recording_id,'qa_remarks'=>$request->qa_remarks]);
        // update status of call logs to 1
        $call_log = $finding->call_log;
        $call_log->status = 1;
        $call_log->save();


        // if finding was created successfully create the disposition, issues, and ztp lol
        if(isset($finding)){
            // insert dispositions
            if(isset($request->finding_dispositions)){
                foreach ($request->finding_dispositions as $disposition) {
                    FindingDisposition::create(['finding_id'=>$finding->id,'disposition_id'=>$disposition]);
                }
            }else{
                FindingDisposition::create(['finding_id'=>$finding->id,'disposition_id'=>$request->agent_dispo]);
            }

            // insert issues
            if(isset($request->finding_issues)){
                foreach ($request->finding_issues as $issue) {
                    FindingIssue::create(['finding_id'=>$finding->id,'agent_system_issue_id'=>$issue]);
                }
            }else{
                FindingIssue::create(['finding_id'=>$finding->id,'agent_system_issue_id'=>$request->agnt_sys_issue]);
            }

            // insert ztp lol
            if(isset($request->finding_ztp_lols)){
                foreach ($request->finding_ztp_lols as $ztp_lol) {
                    FindingZtpLol::create(['finding_id'=>$finding->id,'z_t_p_l_o_l_id'=>$ztp_lol]);
                }
            }else{
                FindingZtpLol::create(['finding_id'=>$finding->id,'z_t_p_l_o_l_id'=>$request->ztp_lol]);
            }

            return redirect()->route('auditor.my_call_logs')->with('success','Audit recorded');
        }else{
            return redirect()->route('auditor.my_call_logs')->with('failed','Failed to record the audit');
        }
    }
}
