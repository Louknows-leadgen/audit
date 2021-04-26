<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\CallLog;
use App\Models\CallLogArchive;
use App\Models\CallLogsAssigned;
use App\Models\Team;
use App\Models\Server;
use App\Models\Campaign;
use App\Models\Disposition;
use App\Models\AssignPreference;
use App\Models\AssignPreferenceDisposition;
use App\Models\UserEmployeeMapping;
use DateTime;
use DateTimeZone;

class SupervisorController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request){
    	$teams = Team::all();
    	$servers = DB::table('calllogs')->distinct()->get('server_ip');
    	$campaigns = DB::table('calllogs')->distinct()->get('campaign');
    	$dispositions = DB::table('calllogs')->distinct()->get('dispo');
        $users = UserEmployeeMapping::orderBy('user_id')->get();

        $servers = $servers->isEmpty() ? $this->get_servers() : $servers;
        $campaigns = $campaigns->isEmpty() ? $this->get_campaigns() : $campaigns;
        $dispositions = $dispositions->isEmpty() ? $this->get_dispositions() : $dispositions;


    	// default from and to date
    	// $from_raw = new DateTime("yesterday", new DateTimeZone('Asia/Kuala_Lumpur'));
    	// $from_dt = $from_raw->format('m/d/Y g:i A');
    	// $to_dt = date('m/d/Y g:i A',strtotime('+23 hour +59 minutes',strtotime($from_dt)));

    	// return view('supervisor.index',compact('calllogs','teams','servers','campaigns','dispositions'));

        $sid = [];
        $campaign = [];
        $dispo = [];
        $from = '';
        $to = '';
        $user = -1;

        // if(empty($request->all()) || !empty($request->page)){
        if(empty($request->from)){
            $calllogs = CallLog::available_calllogs();

            foreach ($servers as $server) {
                array_push($sid, $server->server_ip);
            }

            foreach ($campaigns as $camp) {
                array_push($campaign, $camp->campaign);
            }

            foreach ($dispositions as $disposition) {
                array_push($dispo, $disposition->dispo);
            }
        }else{
            $from = $request->from;
            $to = $request->to;
            $sid = $request->sid;
            $campaign = $request->campaign;
            $dispo = $request->dispo;
            $user = $request->user;
            $calllogs = CallLog::search_call_logs($sid,$campaign,$dispo,$from,$to,$user);
            $calllogs->withPath(route('supervisor.index'));
        }

        return view('supervisor.index',compact('calllogs','teams','servers','campaigns','dispositions','users','sid','campaign','dispo','from','to','user'));
    }

    public function manage_teams(){
        $teams = Team::all();
        return view('supervisor.manage_teams',compact('teams'));
    }

   

    // public function assign_calls(Request $request){
    //     $validator = Validator::make($request->all(),[
    //         'calllogs' => 'required'
    //     ],[
    //         'calllogs.required' => 'No selected call logs'
    //     ]);

    //     if($validator->fails()){
    //         return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
    //     }else{
    //         $calllogs = $request->calllogs;
    //         foreach ($calllogs as $calllog) {
    //             $c = CallLog::find($calllog);
    //             if(empty($c)){
    //                 $c = CallLogArchive::find($calllog);
    //             }
    //             // make sure calllog is not yet assigned before assigning it
    //             if(!isset($c->team_code)){
    //                 $c->team_code = $request->assigned_team;
    //                 $c->save();
    //             }
    //         }
    //         return response()->json(['success'=>'Assigned call logs']);
    //     }
        
    // }

    public function assign_calls(Request $request){
        $validator = Validator::make($request->all(),[
            'calllogs' => 'required'
        ],[
            'calllogs.required' => 'No selected call logs'
        ]);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }else{
            $calllogs = $request->calllogs;
            foreach ($calllogs as $calllog) {
                $c = CallLog::find($calllog);
                if(empty($c)){
                    $c = CallLogArchive::find($calllog);
                }
                // make sure calllog is not yet assigned before assigning it
                if(!isset($c->team_code)){
                    $c->team_code = $request->assigned_team;
                    if($c->save()){
                        $assigned_call = new CallLogsAssigned;
                        $assigned_call->ctr                = $c->ctr;
                        $assigned_call->timestamp          = $c->timestamp;
                        $assigned_call->user               = $c->user;
                        $assigned_call->user_group         = $c->user_group;
                        $assigned_call->audit_type         = $c->audit_type;
                        $assigned_call->phone_number       = $c->phone_number;
                        $assigned_call->recording_id       = $c->recording_id;
                        $assigned_call->recording_filename = $c->recording_filename;
                        $assigned_call->recording_url      = "http://". $c->server_origin. "/RECORDINGS/" . $c->recording_filename . "-all.wav";
                        $assigned_call->server_ip          = $c->server_ip;
                        $assigned_call->server_origin      = $c->server_origin;
                        $assigned_call->campaign           = $c->campaign;
                        $assigned_call->dispo              = $c->dispo;
                        $assigned_call->talk_time          = $c->talk_time;
                        $assigned_call->team_code          = $c->team_code;
                        $assigned_call->is_claimed         = $c->is_claimed;
                        $assigned_call->created_at         = $c->created_at;
                        $assigned_call->updated_at         = $c->updated_at;
                        $assigned_call->claimed_by         = $c->claimed_by;
                        $assigned_call->status             = $c->status;

                        $assigned_call->save();
                    }
                }
            }
            return response()->json(['success'=>'Assigned call logs']);
        }
        
    }


    public function assign_preference(){
        $rules_list = AssignPreference::all();

        return view('supervisor.assign_preference',compact('rules_list'));
    }

    public function assign_preference_edit($id){
        $rule = AssignPreference::find($id);
        $teams = Team::all();
        $dispositions = Disposition::all();
        
        // $assign_pref_dispo = AssignPreferenceDisposition::where('assign_preference_id',$id);
        $assign_pref_dispo = $rule->assign_preference_dispositions;
        $dispo_list = [];
        foreach ($assign_pref_dispo as $disp) {
            $dispo_list[$disp->disposition_id] = $disp->count;
        }

        return view('supervisor.assign_preference_edit',compact('rule','dispositions','teams','dispo_list'));
    }

    public function assign_preference_update($id, Request $request){
        $assign_preference = AssignPreference::find($id);
        $assign_preference->name = $request->name;
        $assign_preference->team_id = $request->team_id;
        $assign_preference->updated_by = Auth::id();
        
        if($assign_preference->save()){
            $id = $assign_preference->id;
            $dispositions = $request->dispo;
            foreach ($dispositions as $dispo_id => $count) {
                $count = isset($count) ? $count : -1;
                $assign_pref_dispo = AssignPreferenceDisposition::updateOrCreate(
                    ['assign_preference_id' => $id,  'disposition_id' => $dispo_id],['count' => $count]
                );

                // echo "dispo: $dispo_id   , count: $count <br><br>";
            }
        }

        return redirect()->route('supervisor.assign_preference');
    }

    public function assign_preference_new(){
        $teams = Team::all();
        $dispositions = Disposition::all(); 

        return view('supervisor.assign_preference_new',compact('dispositions','teams'));
    }

    public function assign_preference_create(Request $request){
        // dd($request->all());
        $assign_preference = new AssignPreference;
        $assign_preference->name = $request->name;
        $assign_preference->team_id = $request->team_id;
        $assign_preference->created_by = Auth::id();
        $assign_preference->updated_by = Auth::id();

        if($assign_preference->save()){
            $id = $assign_preference->id;
            $dispositions = $request->dispo;
            foreach ($dispositions as $dispo_id => $count) {
                $assign_pref_dispo = new AssignPreferenceDisposition;
                $assign_pref_dispo->assign_preference_id = $id;
                $assign_pref_dispo->disposition_id = $dispo_id;
                $assign_pref_dispo->count = empty($count) ? -1 : $count;
                $assign_pref_dispo->save();
            }
        }

        return redirect()->route('supervisor.assign_preference');
    }


    private function get_servers(){
        $servers = [
            (object) ['server_ip' => '38.102.225.152'],
            (object) ['server_ip' => '38.107.183.5'],
            (object) ['server_ip' => '38.102.225.153']
        ];

        return $servers;
    }

    private function get_campaigns(){
        $campaigns = [
            (object) ['campaign' => '3000'],
            (object) ['campaign' => '6000']
        ];

        return $campaigns;
    }


    private function get_dispositions(){
        $dispositions = [
            (object) ['dispo' => 'HUP'],
            (object) ['dispo' => 'A'],
            (object) ['dispo' => 'Lang'],
            (object) ['dispo' => 'NI'],
            (object) ['dispo' => 'RD'],
            (object) ['dispo' => 'NQ'],
            (object) ['dispo' => 'DUMP'],
            (object) ['dispo' => 'DNC'],
            (object) ['dispo' => 'WRNGN'],
            (object) ['dispo' => 'InsHUP'],
            (object) ['dispo' => 'RING'],
            (object) ['dispo' => 'Prank'],
            (object) ['dispo' => 'ROBOT'],
            (object) ['dispo' => 'TrSuc'],
            (object) ['dispo' => 'TRHUP'],
            (object) ['dispo' => 'VM'],
            (object) ['dispo' => 'B'],
            (object) ['dispo' => 'NA'],
            (object) ['dispo' => 'DTO'],
            (object) ['dispo' => 'DEAD'],
            (object) ['dispo' => 'DC'],
            (object) ['dispo' => 'AA'],
            (object) ['dispo' => 'CBHOLD'],
            (object) ['dispo' => '']
        ];

        return $dispositions;
    }

}
