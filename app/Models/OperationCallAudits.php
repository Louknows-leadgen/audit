<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OperationCallAudits extends Model
{

	protected $fillable = [
		'ctr',
		'timestamp',
		'user',
		'user_group',
		'audit_type',
		'phone_number',
		'recording_id',
		'recording_filename',
		'recording_url',
		'server_ip',
		'server_origin',
		'campaign',
		'dispo',
		'talk_time',
		'server_source',
		'team_code',
		'is_claimed',
		'claimed_by',
		'status',
		'ops_user'
	];


	/*
    |-------------------------------------
    |			Associations
    |-------------------------------------*/

    public function ops_script_responses(){
        return $this->hasMany('App\Models\OpsScriptResponse','ctr','ctr');
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

    public static function scopeIsNotAudited($query, $ctr){
    	return $query->where('ctr',$ctr)->get()->count()  > 0 ? false : true;
    }

    public static function scopeMyAudits($query,$value){
    	return $query->where('ops_user',$value);
    }


    // Helpers
    public static function insertToOperationCallAudits($call){
    	$audit = self::create([
					    'ctr' => $call['ctr'],
						'timestamp' => $call['timestamp'],
						'user' => $call['user'],
						'user_group' => $call['user_group'],
						'audit_type' => $call['audit_type'],
						'phone_number' => $call['phone_number'],
						'recording_id' => $call['recording_id'],
						'recording_filename' => $call['recording_filename'],
						'recording_url' => $call['recording_url'],
						'server_ip' => $call['server_ip'],
						'server_origin' => $call['server_origin'],
						'campaign' => $call['campaign'],
						'dispo' => $call['dispo'],
						'talk_time' => $call['talk_time'],
						'server_source' => $call['server_source'],
						'team_code' => $call['team_code'],
						'is_claimed' => $call['is_claimed'],
						'claimed_by' => $call['claimed_by'],
						'status' => $call['status'],
						'ops_user' => $call['ops_user']
				 ]);

    	return $audit;
    }

    public function deleteCallAudit(){
    	$call_audit = $this;
    	if($call_audit->delete()){
    		foreach ($call_audit->ops_script_responses as $ops_script_response){
    			$ops_script_response->deleteOpsScriptResponse();
    		}
    	}
    }
}
