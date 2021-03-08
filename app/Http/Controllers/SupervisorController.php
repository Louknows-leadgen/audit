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

}
