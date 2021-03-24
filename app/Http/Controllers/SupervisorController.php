<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\CallLog;
use App\Models\CallLogArchive;
use App\Models\Team;
use App\Models\Server;
use App\Models\Campaign;
use App\Models\Disposition;
use App\Models\AssignPreference;
use DateTime;
use DateTimeZone;

class SupervisorController extends Controller
{
    //
    public function index(Request $request){
    	$teams = Team::all();
    	$servers = DB::table('calllogs')->distinct()->get('server_ip');
    	$campaigns = DB::table('calllogs')->distinct()->get('campaign');
    	$dispositions = DB::table('calllogs')->distinct()->get('dispo');


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

        if(empty($request->all()) || !empty($request->page)){
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
            $calllogs = CallLog::search_call_logs($sid,$campaign,$dispo,$from,$to);
            $calllogs->withPath(route('supervisor.index'));
        }

        return view('supervisor.index',compact('calllogs','teams','servers','campaigns','dispositions','sid','campaign','dispo','from','to'));

    }

    public function manage_teams(){
        $teams = Team::all();
        return view('supervisor.manage_teams',compact('teams'));
    }

   

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
                    $c->save();
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

        return view('supervisor.assign_preference_edit',compact('rule','teams'));
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
