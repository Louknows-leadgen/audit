<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\CallLogArchive;
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

    // public static function team_claimed_logs($auditor_id){
    //     $user = User::find($auditor_id);
    //     $user_teams = $user->user_teams;
    //     $teams = [];

    //     foreach ($user_teams as $user_team) {
    //         array_push($teams,$user_team->team_code);
    //     }

    //     $call_archived = CallLogArchive::whereIn('team_code',$teams)
    //                      ->where('is_claimed','=',1)
    //                      ->select('ctr','timestamp','user','user_group','phone_number','recording_id','recording_filename','server_ip','server_origin','campaign','dispo','talk_time','team_code','is_claimed','claimed_by','status');

    //     return self::whereIn('team_code',$teams)
    //                ->where('is_claimed','=',1)
    //                ->select('ctr','timestamp','user','user_group','phone_number','recording_id','recording_filename','server_ip','server_origin','campaign','dispo','talk_time','team_code','is_claimed','claimed_by','status')
    //                ->union($call_archived)
    //                ->paginate(10);
    // }


    // public static function my_call_logs($auditor_id){
    //     $call_archived = CallLogArchive::where('claimed_by','=', $auditor_id)
    //                                    ->where('status','=', 0)
    //                                    ->select('ctr','timestamp','user','user_group','phone_number','recording_id','recording_filename','server_ip','server_origin','campaign','dispo','talk_time','team_code','is_claimed','claimed_by','status');

    //     return self::where('claimed_by','=', $auditor_id)
    //                ->where('status','=', 0)
    //                ->select('ctr','timestamp','user','user_group','phone_number','recording_id','recording_filename','server_ip','server_origin','campaign','dispo','talk_time','team_code','is_claimed','claimed_by','status')
    //                ->union($call_archived)
    //                ->paginate(10);
    // }


    // public static function my_call_logs_completed($auditor_id){
    //     $call_archived = CallLogArchive::where('claimed_by','=', $auditor_id)
    //                                    ->where('status','=', 1)
    //                                    ->select('ctr','timestamp','user','user_group','phone_number','recording_id','recording_filename','server_ip','server_origin','campaign','dispo','talk_time','team_code','is_claimed','claimed_by','status');

    //     return self::where('claimed_by','=', $auditor_id)
    //                ->where('status','=', 1)
    //                ->select('ctr','timestamp','user','user_group','phone_number','recording_id','recording_filename','server_ip','server_origin','campaign','dispo','talk_time','team_code','is_claimed','claimed_by','status')
    //                ->union($call_archived)
    //                ->paginate(10);
    // }


    // public static function is_available($call_id){
    //     $call_archived = CallLogArchive::where('ctr','=',$call_id)
    //                                    ->where('is_claimed','=',0)
    //                                    ->select('ctr');

    //     return self::where('ctr','=',$call_id)
    //                ->where('is_claimed','=',0)
    //                ->select('ctr')
    //                ->union($call_archived)
    //                ->exists();
    // }


    // public static function bulk_claim($auditor_id, $calllogs){
    //     $ca_numrows = CallLogArchive::whereIn('ctr',$calllogs)
    //                                 ->where('is_claimed','=',0)
    //                                 ->update(['is_claimed'=>1, 'claimed_by'=>$auditor_id]);

    //     $c_numrows = self::whereIn('ctr',$calllogs)
    //                      ->where('is_claimed','=',0)
    //                      ->update(['is_claimed'=>1, 'claimed_by'=>$auditor_id]);

    //     return $ca_numrows || $c_numrows ? 1 : 0; // return 1 if there are records updated. else 0
    // }

    public static function release_user_calls($user_id){
        $calls_archived = CallLogArchive::where('claimed_by','=',$user_id)
                                        ->where('status','!=',1)
                                        ->get();


        foreach ($calls_archived as $ca) {
            $ca->is_claimed = 0;
            $ca->claimed_by = 0;
            $ca->save();

            // remove answers from recording_scripts table
            RecordingScript::remove_responses($ca->recording_id);
        }


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
        $calls_archived = CallLogArchive::where('team_code','=',$team_id)
                                        ->where('status','!=',1)
                                        ->get();

        foreach ($calls_archived as $ca) {
            $ca->is_claimed = 0;
            $ca->claimed_by = 0;
            $ca->team_code = null;
            $ca->save();

            // remove answers from recording_scripts table
            RecordingScript::remove_responses($ca->recording_id);
        }
                                        

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
