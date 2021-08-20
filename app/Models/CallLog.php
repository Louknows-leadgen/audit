<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\CallLogArchive;
use App\Models\Api\VicidialLog;
use App\Models\Api\VicidialLogArchive;
use App\Models\Host;
use \DateTime;

class CallLog extends Model
{
    // specify table to be used for this model (Legacy table)
    protected $table = 'calllogs';
    // specify primary key of the table for the legacy table
    protected $primaryKey = 'ctr';


    /*
    |-------------------------------------
    |			Associations
    |-------------------------------------*/

    public function auditor(){
        return $this->belongsTo('App\Models\User','claimed_by');
    }

    public function script_responses(){
        return $this->hasMany('App\Models\ScriptResponse','recording_id','recording_id');
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
                "161.49.118.21"  => "cl4",
                "161.49.118.20"  => "cl5",
                "207.188.12.131" => "cl6"];

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
        $host = $this->getHost();
        $wav_url = "{$host}/RECORDINGS/{$this->recording_filename}-all.wav";
        $mp3_url = "{$host}/RECORDINGS/MP3/{$this->recording_filename}-all.mp3";
        $arch_url = "{$host}/archive/{$date}/{$this->recording_filename}-all.mp3";
        $check_url_api = route('api.recording.check_url');

        return (object) ['wav' => $wav_url, 'mp3' => $mp3_url, 'archive' => $arch_url, 'check_url_api' => $check_url_api];
    }

    public function getHost(){
        return Host::where('server',$this->server_origin)->first()->hostname;
    }

   
    /*
    |-------------------------------------
    |           Custom Functions
    |-------------------------------------*/


    public static function search_call_logs_test(){
        $user = 1;

        $calls = self::where('user_group','TEAMVIVIAN')
                 ->when($user == 1, function($q){
                        return $q->where('user',4096);
                   })
                 ->get();

        return $calls;
    }


    public static function search_call_logs($sid,$campaign,$dispo,$from,$to,$user){

        if($user == '-1'){
            $calls = DB::table('calllogs')
                     ->select('ctr','timestamp','user','user_group','phone_number','recording_id','recording_filename','server_ip','server_origin','campaign','dispo','talk_time','team_code','is_claimed','claimed_by','status')
                     ->whereDate('timestamp','>=',date('Y-m-d',strtotime($from)))
                     ->whereDate('timestamp','<',date('Y-m-d',strtotime($to)))
                     ->whereIn('server_ip',$sid)
                     ->whereIn('campaign',$campaign)
                     ->whereIn('dispo',$dispo)
                     ->whereNull('team_code')
                     ->where('recording_id','!=','');


            $all_calls = DB::table('calllogs_archive_search')
                     ->select('ctr','timestamp','user','user_group','phone_number','recording_id','recording_filename','server_ip','server_origin','campaign','dispo','talk_time','team_code','is_claimed','claimed_by','status')
                     ->whereDate('timestamp','>=',date('Y-m-d',strtotime($from)))
                     ->whereDate('timestamp','<',date('Y-m-d',strtotime($to)))
                     ->whereIn('server_ip',$sid)
                     ->whereIn('campaign',$campaign)
                     ->whereIn('dispo',$dispo)
                     ->whereNull('team_code')
                     ->where('recording_id','!=','')
                     ->union($calls)
                     ->paginate(50);
        }else{
            $calls = DB::table('calllogs')
                     ->select('ctr','timestamp','user','user_group','phone_number','recording_id','recording_filename','server_ip','server_origin','campaign','dispo','talk_time','team_code','is_claimed','claimed_by','status')
                     ->whereDate('timestamp','>=',date('Y-m-d',strtotime($from)))
                     ->whereDate('timestamp','<',date('Y-m-d',strtotime($to)))
                     ->whereIn('server_ip',$sid)
                     ->whereIn('campaign',$campaign)
                     ->whereIn('dispo',$dispo)
                     ->whereNull('team_code')
                     ->where('user',$user) // added condition if user is not -1
                     ->where('recording_id','!=','');


            $all_calls = DB::table('calllogs_archive_search')
                     ->select('ctr','timestamp','user','user_group','phone_number','recording_id','recording_filename','server_ip','server_origin','campaign','dispo','talk_time','team_code','is_claimed','claimed_by','status')
                     ->whereDate('timestamp','>=',date('Y-m-d',strtotime($from)))
                     ->whereDate('timestamp','<',date('Y-m-d',strtotime($to)))
                     ->whereIn('server_ip',$sid)
                     ->whereIn('campaign',$campaign)
                     ->whereIn('dispo',$dispo)
                     ->whereNull('team_code')
                     ->where('user',$user) // added condition if user is not -1
                     ->where('recording_id','!=','')
                     ->union($calls)
                     ->paginate(50);
        }


        return $all_calls;
    }


    public static function available_calllogs(){
        return self::whereNull('team_code')
                   ->where('recording_id','!=','')
                   ->select('ctr','timestamp','user','user_group','phone_number','recording_id','recording_filename','server_ip','server_origin','campaign','dispo','talk_time','team_code','is_claimed','claimed_by','status')
                   ->paginate(50);
    }

    public static function team_available_logs($auditor_id){
        $user = User::find($auditor_id);
        $user_teams = $user->user_teams;
        $teams = [];

        foreach ($user_teams as $user_team) {
            array_push($teams,$user_team->team_code);
        }

        $call_archived = CallLogArchive::whereIn('team_code',$teams)
                         ->where('is_claimed','=',0)
                         ->select('ctr','timestamp','user','user_group','phone_number','recording_id','recording_filename','server_ip','server_origin','campaign','dispo','talk_time','team_code','is_claimed','claimed_by','status');

        return self::whereIn('team_code',$teams)
                   ->where('is_claimed','=',0)
                   ->select('ctr','timestamp','user','user_group','phone_number','recording_id','recording_filename','server_ip','server_origin','campaign','dispo','talk_time','team_code','is_claimed','claimed_by','status')
                   ->union($call_archived)
                   ->paginate(10);
    }

    
    public static function agents_audited(){
        return self::where('status','=',1)
                   ->groupBy('user')
                   ->get('user');
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
