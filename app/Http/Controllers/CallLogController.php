<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\CallLog;
use App\Models\CallLogsAssigned;
use App\Models\CallLogArchive;

class CallLogController extends Controller
{
    //
    // public function audited_by_agents(){
    // 	$agents = CallLog::agents_audited();

    // 	return view('call_log.audited_by_agents',compact('agents'));
    // }

    // public function search_form(){
    // 	return view('call_log.search_page');
    // }


    public function search(Request $request){
        $phone_number = $request->phone_number;
        
        $calllog = [];
        if(!empty($phone_number)){
            $calllog = CallLogsAssigned::where('phone_number',$phone_number)->first();
            if(empty($calllog)){
                $calllog = CallLog::where('phone_number',$phone_number)->first();
                if(empty($calllog)){
                    $calllog = CallLogArchive::where('phone_number',$phone_number)->first();
                }
            }
        }

        return view('call_log.search_page',compact('calllog','phone_number'));
    }

    // public function tag_call(Request $request){
    //     $audit_type = $request->audit_type;
    //     $ctr = $request->ctr;

    //     $call = CallLogsAssigned::find($ctr);
    //     if(empty($call)){
    //         $call = CallLog::find($ctr);
    //         if(empty($call)){
    //             $call = CallLogArchive::find($ctr);
    //         }    
    //     }
        

    //     if(!empty($call)){
    //         if($call->is_claimed == 0){
    //             $userid = Auth::id();
    //             $call->is_claimed = 1;
    //             $call->team_code = User::find($userid)->user_teams->first()->team_code;
    //             $call->claimed_by = $userid;    
    //         }
    //         $call->audit_type = $audit_type;
    //         $call->save();
    //         return redirect()->route('auditor.recording',['recording'=>$call->recording_id]);
    //     }else{
    //         return redirect()->route('call.search',['phone_number'=>$call->phone_number])->with('fail','Recording not found');
    //     }
    // }


    public function tag_call(Request $request){
        $audit_type = $request->audit_type;
        $ctr = $request->ctr;

        $call = CallLogsAssigned::find($ctr);
        if(empty($call)){
            $call = CallLog::find($ctr);
            if(empty($call)){
                $call = CallLogArchive::find($ctr);
            } 

            if(!empty($call)){
                if($call->is_claimed == 0){
                    $userid = Auth::id();
                    $call->is_claimed = 1;
                    $call->team_code = User::find($userid)->user_teams->first()->team_code;
                    $call->claimed_by = $userid;
                }
                $call->audit_type = $audit_type;
                $call->save();

                // insert to assigned calllogs
                $cla = new CallLogsAssigned;
                $cla->ctr = $call->ctr;
                $cla->timestamp = $call->timestamp;
                $cla->user = $call->user;
                $cla->user_group = $call->user_group;
                $cla->audit_type = $call->audit_type;
                $cla->phone_number = $call->phone_number;
                $cla->recording_id = $call->recording_id;
                $cla->recording_filename = $call->recording_filename;
                $cla->recording_url = $this->generate_recording_url($call)['url'];
                $cla->server_ip = $call->server_ip;
                $cla->server_origin = $call->server_origin;
                $cla->campaign = $call->campaign;
                $cla->dispo = $call->dispo;
                $cla->talk_time = $call->talk_time;
                $cla->team_code = $call->team_code;
                $cla->is_claimed = $call->is_claimed;
                $cla->created_at = $call->created_at;
                $cla->updated_at = $call->updated_at;
                $cla->claimed_by = $call->claimed_by;
                $cla->status = $call->status;
                $cla->save();
            }  
        }else{
            $userid = Auth::id();
            $call->is_claimed = 1;
            $call->claimed_by = $userid;
            $call->audit_type = $audit_type;
            $call->save();
        }

        return redirect()->route('auditor.recording',['recording'=>$call->recording_id]);

    }


    private function generate_recording_url($calllog){
        $urls = [];
        $filename = $calllog->recording_filename;
        $server = $calllog->server_origin;
        $date = date('Y-m-d',strtotime($calllog->timestamp));

        array_push($urls, ['type' => 'wav', 'url' => "http://$server/RECORDINGS/$filename-all.wav"]);
        array_push($urls, ['type' => 'mpeg', 'url' => "http://$server/RECORDINGS/MP3/$filename-all.mp3"]);
        array_push($urls, ['type' => 'mpeg', 'url' => "http://38.102.225.164/archive/$date/$filename-all.mp3"]);

        $url = [];
        foreach ($urls as $endpoint) {
            $response = $this->check_url($endpoint['url']);
            if($response == '200'){
                $url = $endpoint;
                break;
            }
        }

        return $url;
    }


    private function check_url($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        $headers = curl_getinfo($ch);
        curl_close($ch);

        return $headers['http_code'];
    }

}
