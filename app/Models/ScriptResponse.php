<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\CallLog;
use App\Models\CallLogArchive;
use App\Models\Response;

class ScriptResponse extends Model
{
    //
    protected $fillable = [
    	'recording_id',
    	'script_id',
    	'cust_statement',
    	'aud_comment',
    	'inc_tagging',
    	'inapp_resp',
    	'inc_detail'
    ];

    public static function responses($recording_id,$script_id){
        return self::where('recording_id','=',$recording_id)
                   ->where('script_id','=',$script_id)
                   ->first();
    }

    /*
    |----------------------------------
    |        Association
    |----------------------------------*/

    public function calllog(){
        return $this->belongsTo('App\Models\CallLog','recording_id','recording_id');
    }

    public function calllog_archive(){
        return $this->belongsTo('App\Models\CallLogArchive','recording_id','recording_id');
    }

    public function script(){
        return $this->belongsTo('App\Models\Script');
    }

    public function agent_script_responses(){
        return $this->hasMany('App\Models\AgentScriptResponse');
    }

    public function external_script_response(){
        return $this->hasMany('App\Models\ExternalScriptResponse');
    }


    // public static function call_responses($from, $to){
    //     $calllogs_base = DB::table('calllogs as c')
    //                             ->join('script_responses as sr','c.recording_id','=','sr.recording_id')
    //                             ->whereDate('timestamp','>=',date('Y-m-d',strtotime($from)))
    //                             ->whereDate('timestamp','<',date('Y-m-d',strtotime($to)))
    //                             ->select('c.ctr')
    //                             ->distinct();

    //     $calllogs = DB::table('calllogs_archive_search as ca')
    //                             ->join('script_responses as sr','ca.recording_id','=','sr.recording_id')
    //                             ->whereDate('timestamp','>=',date('Y-m-d',strtotime($from)))
    //                             ->whereDate('timestamp','<',date('Y-m-d',strtotime($to)))
    //                             ->select('ca.ctr')
    //                             ->distinct()
    //                             ->union($calllogs_base)
    //                             ->get();


    //     $calllog_responses = [];
    //     foreach ($calllogs as $c) {           
    //         $calllog = CallLog::find($c->ctr);
    //         if(empty($calllog)){
    //             $calllog = CallLogArchive::find($c->ctr);
    //         }

    //         $recording_link = self::get_recording_link($calllog);

    //         foreach ($calllog->script_responses as $sr) {
    //             $response = new Response;

    //             $response->auditor = $calllog->auditor->email;
    //             $response->audit_type = $calllog->audit_type;
    //             $response->recording_id = $calllog->recording_id;
    //             $response->recording_link = $recording_link;
    //             $response->user = $calllog->user;
    //             $response->user_group = $calllog->user_group;
    //             $response->phone_number = $calllog->phone_number;
    //             $response->server = $calllog->server_origin;
    //             $response->campaign = $calllog->campaign;
    //             $response->dispo = $calllog->dispo;
    //             $response->talk_time = $calllog->talk_time;
    //             $response->script = $sr->script->name;
    //             $response->cust_statement = $sr->cust_statement;
    //             $response->aud_comment = $sr->aud_comment;

    //             $agent_corrections = [];
    //             foreach ($sr->agent_script_responses as $ac) {
    //                 array_push($agent_corrections, $ac->agent_correction->name);
    //             }
                
    //             $response->agent_correction = implode(', ', $agent_corrections);
    //             $response->inc_tagging = $sr->inc_tagging;
    //             $response->inapp_resp = $sr->inapp_resp;
    //             $response->inc_detail = $sr->inc_detail;

    //             $external_factors = [];
    //             foreach ($sr->external_script_response as $ef) {
    //                 array_push($external_factors, $ef->external_factor->name);
    //             }

    //             $response->external_factors = implode(', ', $external_factors);

    //             array_push($calllog_responses, $response);
    //         }         
    //     }

    //     return $calllog_responses;
    // }

    public static function call_responses($from, $to){
        $calllogs_base = CallLog::whereDate('timestamp','>=',date('Y-m-d',strtotime($from)))
                                ->whereDate('timestamp','<',date('Y-m-d',strtotime($to)))
                                ->where('status',1)
                                ->select('ctr', 'recording_id', 'recording_filename', 'server_origin', 'timestamp', 'audit_type', 'user', 'user_group', 'phone_number', 'campaign', 'dispo', 'talk_time','claimed_by');

        $calllogs = CallLogArchive::whereDate('timestamp','>=',date('Y-m-d',strtotime($from)))
                                ->whereDate('timestamp','<',date('Y-m-d',strtotime($to)))
                                ->where('status',1)
                                ->select('ctr', 'recording_id', 'recording_filename', 'server_origin', 'timestamp', 'audit_type', 'user', 'user_group', 'phone_number', 'campaign', 'dispo', 'talk_time','claimed_by')
                                ->union($calllogs_base)
                                ->get();


        $calllog_responses = [];
        foreach ($calllogs as $calllog) {           
            $recording_link = self::get_recording_link($calllog);

            if(count($calllog->script_responses) > 0){
                foreach ($calllog->script_responses as $sr) {
                    $response = new Response;

                    $response->auditor = $calllog->auditor->email;
                    $response->audit_type = $calllog->audit_type;
                    $response->recording_id = $calllog->recording_id;
                    $response->recording_link = $recording_link;
                    $response->user = $calllog->user;
                    $response->user_group = $calllog->user_group;
                    $response->phone_number = $calllog->phone_number;
                    $response->server = $calllog->server_origin;
                    $response->campaign = $calllog->campaign;
                    $response->dispo = $calllog->dispo;
                    $response->talk_time = $calllog->talk_time;
                    $response->script = $sr->script->name;
                    $response->cust_statement = $sr->cust_statement;
                    $response->aud_comment = $sr->aud_comment;

                    $agent_corrections = [];
                    foreach ($sr->agent_script_responses as $ac) {
                        array_push($agent_corrections, $ac->agent_correction->name);
                    }
                    
                    $response->agent_correction = implode(', ', $agent_corrections);
                    $response->inc_tagging = $sr->inc_tagging;
                    $response->inapp_resp = $sr->inapp_resp;
                    $response->inc_detail = $sr->inc_detail;

                    $external_factors = [];
                    foreach ($sr->external_script_response as $ef) {
                        array_push($external_factors, $ef->external_factor->name);
                    }

                    $response->external_factors = implode(', ', $external_factors);

                    array_push($calllog_responses, $response);
                } 
            }else{
                $response = new Response;
                $response->auditor = $calllog->auditor->email;
                $response->audit_type = $calllog->audit_type;
                $response->recording_id = $calllog->recording_id;
                $response->recording_link = $recording_link;
                $response->user = $calllog->user;
                $response->user_group = $calllog->user_group;
                $response->phone_number = $calllog->phone_number;
                $response->server = $calllog->server_origin;
                $response->campaign = $calllog->campaign;
                $response->dispo = $calllog->dispo;
                $response->talk_time = $calllog->talk_time;
                $response->script = '';
                $response->cust_statement = '';
                $response->aud_comment = '';
                $response->agent_correction = '';
                $response->inc_tagging = '';
                $response->inapp_resp = '';
                $response->inc_detail = '';
                $response->external_factors = '';

                array_push($calllog_responses, $response);
            }       
        }

        return $calllog_responses;
    }



    private static function get_recording_link($calllog){
        $url = '';
        $filename = $calllog->recording_filename;
        $server = $calllog->server_origin;
        $date = date('Y-m-d',strtotime($calllog->timestamp));

        if(self::check_url("http://$server/RECORDINGS/$filename-all.wav") == '200'){
            $url = "http://$server/RECORDINGS/$filename-all.wav";
        }elseif (self::check_url("http://$server/RECORDINGS/MP3/$filename-all.mp3") == '200'){
            $url = "http://$server/RECORDINGS/MP3/$filename-all.mp3";
        }else{
            $url = "http://38.102.225.164/archive/$date/$filename-all.mp3";
        }

        return $url;
    }

    private static function check_url($url) {
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
