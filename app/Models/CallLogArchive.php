<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallLogArchive extends Model
{
    // specify table to be used for this model (Legacy table)
    protected $table = 'calllogs_archive_search';
    // specify primary key of the table for the legacy table
    protected $primaryKey = 'ctr';


    public function script_responses(){
        return $this->hasMany('App\Models\ScriptResponse','recording_id','recording_id');
    }

    public function auditor(){
        return $this->belongsTo('App\Models\User','claimed_by');
    }


    /*
    |-------------------------------------
    |           Custom Attributes
    |-------------------------------------*/

    protected $appends = ['status_name','hangup_reason','recording_urls'];

    public function getStatusNameAttribute(){
        return $this->status == 1 ? 'Completed' : 'Not Started';
    }

    public function getHangupReasonAttribute(){
        $param_server = $this->server_ip;
        $param_recording_id = $this->recording_id;
        $param_phone = $this->phone_number;
        $param_user = $this->user;
        
        $env = ["38.102.225.152" => "cl1",
                "38.102.225.153" => "cl2",
                "38.107.183.3"   => "cl3",
                "161.49.118.21"  => "cl4"];

        if(isset($env[$param_server]))
            return $this->queryHangupReason($env[$param_server], $param_recording_id, $param_phone, $param_user);
        else
            return 'Server not found';
        
    }

    private function queryHangupReason($server, $recording_id, $phone, $user){
        $vlog = DB::connection($server)->table('recording_log as rl')
                                       ->leftJoin('vicidial_log as vl','vl.lead_id','=','rl.lead_id')
                                       ->select('vl.term_reason')
                                       ->where('rl.recording_id',$recording_id)
                                       ->where('vl.user',$user)
                                       ->where('vl.phone_number',$phone)->get();

        $vlog_arch = DB::connection($server)->table('recording_log as rl')
                                            ->leftJoin('vicidial_log_archive as vl','vl.lead_id','=','rl.lead_id')
                                            ->select('vl.term_reason')
                                            ->where('rl.recording_id',$recording_id)
                                            ->where('vl.user',$user)
                                            ->where('vl.phone_number',$phone)->get();


       $merged = $vlog->merge($vlog_arch)->first();
       return isset($merged->term_reason) ? $merged->term_reason : 'No Result';
    }

    public function getRecordingUrlsAttribute(){
        $date = date('Y-m-d',strtotime($this->timestamp));
        $wav_url = "http://{$this->server_origin}/RECORDINGS/{$this->recording_filename}-all.wav";
        $mp3_url = "http://{$this->server_origin}/RECORDINGS/MP3/{$this->recording_filename}-all.mp3";
        $arch_url = "http://38.102.225.164/archive/{$date}/{$this->recording_filename}-all.mp3";
        $check_url_api = route('api.recording.check_url');

        return (object) ['wav' => $wav_url, 'mp3' => $mp3_url, 'archive' => $arch_url, 'check_url_api' => $check_url_api];
    }


    // Scopes
    public function scopeDistinctDispo($query){
        return $query->distinct()->orderBy('dispo','asc')->get('dispo');
    }

    public function scopeWhereBetweenDates($query, $col, $from = null, $to = null){
        if(empty($from) || empty($to)){
            date_default_timezone_set('America/New_York');
            $currdt = date('Y-m-d');
            $from = date('Y-m-d',strtotime($currdt . ' -2 days'));
            $to = date('Y-m-d',strtotime($currdt . ' -1 days'));
        }

        return $query->where($col,'>=', $from)
                     ->where($col,'<', $to);
    }

    public function scopeWhereDispoIn($query, $dispo = []){
        if(empty($dispo))
            return $query;
        
        return $query->whereIn('dispo',$dispo);
    }

    public function scopeWhereUserIs($query, $user = null){
        if(empty($user))
            return $query;

        return $query->where('user',$user);
    }
}
