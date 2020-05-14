<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\User;
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
    |           Custom Functions
    |-------------------------------------*/

    public static function search_call_logs($from,$to,$sid,$campaign,$dispo){
        $from = date_create_from_format("m/d/Y g:i A",$from);
        $from_dt = $from->format('Y-m-d');
        $from_time = $from->format('G:i');

        $to = date_create_from_format("m/d/Y g:i A",$to);
        $to_dt = $to->format('Y-m-d');
        $to_time = $to->format('G:i');

        $calls = DB::table('calllogs')
                 ->where(function($query) use ($from_dt,$from_time){
                    $query->whereDate('timestamp','>=',$from_dt)
                          ->whereTime('timestamp','>=',$from_time);
                 })
                 ->where(function($query) use ($to_dt,$to_time){
                    $query->whereDate('timestamp','<=',$to_dt)
                          ->whereTime('timestamp','<=',$to_time);
                 })
                 ->whereIn('server_ip',$sid)
                 ->whereIn('campaign',$campaign)
                 ->whereIn('dispo',$dispo)
                 ->whereNull('team_code')
                 ->get();

        return $calls;
    }

    public static function available_calllogs(){
        return self::whereNull('team_code')->get();
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
        return self::where('claimed_by','=',$auditor_id)
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
}
