<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\CallLogArchive;
use App\Models\CallLog;
use App\Models\Host;

class CallLogsAssigned extends Model
{
    //
    protected $table = 'calllogs_assigned';
    protected $primaryKey = 'ctr';

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
      'created_at',
      'updated_at',
      'claimed_by',
      'status'
    ];


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
    |           Custom Methods
    |-------------------------------------*/

    public static function team_available_logs($auditor_id){
        $user = User::find($auditor_id);
        $user_teams = $user->user_teams;
        $teams = [];

        foreach ($user_teams as $user_team) {
            array_push($teams,$user_team->team_code);
        }

        return self::whereIn('team_code',$teams)
                   ->where('is_claimed','=',0)
                   ->where('recording_id','!=','')
                   ->paginate(10);
    }


    public static function is_available($call_id){
        return self::where('ctr','=',$call_id)
                   ->where('is_claimed','=',0)
                   ->select('ctr')
                   ->exists();
    }

    public static function is_not_assigned($call_id){
       return empty(self::find($call_id));
    }

    public static function insertFromCallLog($calllog){
      return self::create([
                'ctr' => $calllog->ctr,
                'timestamp' => $calllog->timestamp,
                'user' => $calllog->user,
                'user_group' => $calllog->user_group,
                'audit_type' => $calllog->audit_type,
                'phone_number' => $calllog->phone_number,
                'recording_id' => $calllog->recording_id,
                'recording_filename' => $calllog->recording_filename,
                'recording_url' => $calllog->recording_url,
                'server_ip' => $calllog->server_ip,
                'server_origin' => $calllog->server_origin,
                'campaign' => $calllog->campaign,
                'dispo' => $calllog->dispo,
                'talk_time' => $calllog->talk_time,
                'server_source' => $calllog->server_source,
                'team_code' => $calllog->team_code,
                'is_claimed' => $calllog->is_claimed,
                'created_at' => $calllog->created_at,
                'updated_at' => $calllog->updated_at,
                'claimed_by' => $calllog->claimed_by,
                'status' => $calllog->status
             ]);
    }

    public static function bulk_claim($auditor_id, $calllogs){
        $c_numrows = self::whereIn('ctr',$calllogs)
                         ->where('is_claimed','=',0)
                         ->update(['is_claimed'=>1, 'claimed_by'=>$auditor_id]);

        return $c_numrows ? 1 : 0; // return 1 if there are records updated. else 0
    }

    public static function findby_recording_id($recording_id){
        // return self::where('recording_id','=',$recording_id)->first();
        return self::where('recording_id','=',$recording_id)
                       ->select('ctr','timestamp','user','user_group','phone_number','recording_id','recording_filename','server_ip','server_origin','campaign','dispo','talk_time','team_code','is_claimed','claimed_by','status')
                       ->first();
    }


    public static function my_call_logs_completed($auditor_id){
        return self::where('claimed_by','=', $auditor_id)
                   ->where('status','=', 1)
                   ->paginate(10);
    }


    public static function my_call_logs($auditor_id){
        return self::where('claimed_by','=', $auditor_id)
                   ->where('status','=', 0)
                   ->paginate(10);
    }


    public static function team_claimed_logs($auditor_id){
        $user = User::find($auditor_id);
        $user_teams = $user->user_teams;
        $teams = [];

        foreach ($user_teams as $user_team) {
            array_push($teams,$user_team->team_code);
        }

        return self::whereIn('team_code',$teams)
                   ->where('is_claimed','=',1)
                   ->paginate(10);
    }

    public static function hourly_count($auditor, $audit_dt){
        $to_dt = date('Y-m-d', strtotime("+1 day", strtotime($audit_dt)));

        return self::where('claimed_by',$auditor)
                   ->where('is_claimed',1)
                   ->where('status',1)
                   ->where('audit_end','>=',$audit_dt)
                   ->where('audit_end','<',$to_dt)
                   ->select(DB::raw("DATE_FORMAT(audit_end,'%H') as hr, count(1) as ctr"))
                   ->groupBy('hr')
                   ->orderBy('hr','asc')
                   ->get();
    }

    public static function audited_logs(){
      return self::where('is_claimed',1)
                 ->where('status',1)
                 ->paginate(10);
    }


    public static function release_calls($team_id){
        $assigned_calls = self::where('team_code',$team_id);

        foreach ($assigned_calls->get() as $call){
            // delete responses
            foreach ($call->script_responses as $script_response) {
              $script_response->deleteScriptResponse();
            }

            $callog = CallLog::find($call->ctr);

            // search in archive table if not found on callog table
            if(empty($callog))
                $callog = CallLogArchive::find($call->ctr);

            // if callog is found, then free up the team assigned
            if(!empty($callog)){
                $callog->team_code = null;
                $callog->is_claimed = 0;
                $callog->claimed_by = 0;
                $callog->status = 0;
                $callog->save();
            }
        }

        // bulk remove the calls on the calls assigned table
        $assigned_calls->delete();
    }

    public static function release_user_calls($user_id, $user_team_id){
        $assigned_calls = self::where('team_code',$user_team_id)
                              ->where('claimed_by',$user_id);

        foreach ($assigned_calls->get() as $call){
            // delete responses
            foreach ($call->script_responses as $script_response) {
              $script_response->deleteScriptResponse();
            }

            $callog = CallLog::find($call->ctr);

            // search in archive table if not found on callog table
            if(empty($callog))
                $callog = CallLogArchive::find($call->ctr);

            // if callog is found, then free up the team assigned
            if(!empty($callog)){
                $callog->team_code = null;
                $callog->is_claimed = 0;
                $callog->claimed_by = 0;
                $callog->status = 0;
                $callog->save();
            }
        }

        // bulk remove the calls on the calls assigned table
        $assigned_calls->delete();

    }


    // Used in:
    // Controller: OperationAuditorController 
    // Method: search 
    public static function scopeWhereLikeCompleted($query, $column ,$value){
      return $query->where('status',1)
                   ->where($column,'like','%'. $value .'%');
    }

    public static function scopeWhereDateEqualCompleted($query, $column, $value){
      $stop_date = date('Y-m-d', strtotime($value . ' +1 day'));
      return $query->where('status',1)
                   ->where($column,'>=',$value)
                   ->where($column,'<',$stop_date);
    }
}
