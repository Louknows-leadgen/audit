<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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
}
