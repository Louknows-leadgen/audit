<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class CallLogsAssigned extends Model
{
    //
    protected $table = 'calllogs_assigned';
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

    protected $appends = ['status_name'];

    public function getStatusNameAttribute(){
        return $this->status == 1 ? 'Completed' : 'Not Started';
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
}
