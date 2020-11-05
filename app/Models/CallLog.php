<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\RecordingScript;
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

    public function user_list(){
    	return $this->belongsTo('App\Models\UserList','user','user');
    }

    public function auditor(){
        return $this->belongsTo('App\Models\User','claimed_by');
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
    |           Custom Functions
    |-------------------------------------*/

    // public static function search_call_logs($from,$to,$sid,$campaign,$dispo){
    //     $from = date_create_from_format("m/d/Y g:i A",$from);
    //     $from_dt = $from->format('Y-m-d');
    //     $from_time = $from->format('G:i');

    //     $to = date_create_from_format("m/d/Y g:i A",$to);
    //     $to_dt = $to->format('Y-m-d');
    //     $to_time = $to->format('G:i');

    //     $calls = DB::table('calllogs')
    //              ->where('timestamp','>=',$from)
    //              ->where('timestamp','<=',$to)
    //              ->whereIn('server_ip',$sid)
    //              ->whereIn('campaign',$campaign)
    //              ->whereIn('dispo',$dispo)
    //              ->whereNull('team_code')
    //              ->get();

    //     return $calls;
    // }

    public static function search_call_logs($sid,$campaign,$dispo){

        $calls = DB::table('calllogs')
                 ->whereIn('server_ip',$sid)
                 ->whereIn('campaign',$campaign)
                 ->whereIn('dispo',$dispo)
                 ->whereNull('team_code')
                 ->paginate(50);

        return $calls;
    }

    public static function available_calllogs(){
        return self::whereNull('team_code')->paginate(50);
    }

    public static function team_available_logs($auditor_id){
        $user = User::find($auditor_id);
        $user_teams = $user->user_teams;
        $teams = [];

        foreach ($user_teams as $user_team) {
            array_push($teams,$user_team->team_code);
        }

        return self::whereIn('team_code',$teams)
                   ->where('is_claimed','=',0)
                   ->get();
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
                   ->get();
    }


    public static function my_call_logs($auditor_id){
        return self::where('claimed_by','=', $auditor_id)
                   ->where('status','=', 0)
                   ->get();
    }


    public static function is_available($call_id){
        return self::where('ctr','=',$call_id)
                   ->where('is_claimed','=',0)
                   ->exists();
    }


    public static function bulk_claim($auditor_id, $calllogs){
        return self::whereIn('ctr',$calllogs)
                   ->where('is_claimed','=',0)
                   ->update(['is_claimed'=>1, 'claimed_by'=>$auditor_id]);
    }

    public static function release_user_calls($user_id){
        $calls = self::where('claimed_by','=',$user_id)
                     ->where('status','!=',1)
                     ->get();

        foreach ($calls as $call) {
            $call->is_claimed = 0;
            $call->claimed_by = 0;
            $call->save();

            // remove answers from recording_scripts table
            RecordingScript::remove_responses($call->recording_id);
        }
    }

    public static function release_calls($team_id){
        $calls = self::where('team_code','=',$team_id)
                     ->where('status','!=',1)
                     ->get();

        foreach ($calls as $call) {
            $call->is_claimed = 0;
            $call->claimed_by = 0;
            $call->team_code = null;
            $call->save();

            // remove answers from recording_scripts table
            RecordingScript::remove_responses($call->recording_id);
        }
    }

    public static function agents_audited(){
        return self::where('status','=',1)
                   ->groupBy('user')
                   ->get('user');
    }

    public static function findby_recording_id($recording_id){
        return self::where('recording_id','=',$recording_id)->first();
    }
}
