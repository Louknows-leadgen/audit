<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\CallLog;
use App\Models\Team;
use App\Models\Server;
use App\Models\Campaign;
use App\Models\Disposition;
use DateTime;
use DateTimeZone;

class SupervisorController extends Controller
{
    //
    public function index(){
    	$calllogs = CallLog::available_calllogs();
    	$teams = Team::all();
    	$servers = Server::all();
    	$campaigns = Campaign::all();
    	$dispositions = Disposition::all();

    	// default from and to date
    	$from_raw = new DateTime("yesterday", new DateTimeZone('Asia/Kuala_Lumpur'));
    	$from_dt = $from_raw->format('m/d/Y g:i A');
    	$to_dt = date('m/d/Y g:i A',strtotime('+23 hour +59 minutes',strtotime($from_dt)));

    	return view('supervisor.index',compact('calllogs','teams','servers','campaigns','dispositions','from_dt','to_dt'));
    }

    public function manage_teams(){
        $teams = Team::all();
        return view('supervisor.manage_teams',compact('teams'));
    }

    public function search_calls(Request $request){
    	$from = $request->from;
    	$to = $request->to;
    	$sid = $request->sid;
    	$campaign = $request->campaign;
    	$dispo = $request->dispo;
    	$calls = CallLog::search_call_logs($from,$to,$sid,$campaign,$dispo);
    	return view('call_log.search_result',compact('calls'));
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
