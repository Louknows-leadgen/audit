<?php

namespace App\Http\Controllers;

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
    	$calllogs = CallLog::all();
    	$teams = Team::all();
    	$servers = Server::all();
    	$campaigns = Campaign::all();
    	$dispositions = Disposition::all();

    	// default from and to date
    	$currentDt_raw = new DateTime("now", new DateTimeZone('Asia/Kuala_Lumpur'));
    	$curr_dt = $currentDt_raw->format('m/d/Y, H:i:s');

    	return view('supervisor.index',compact('calllogs','teams','servers','campaigns','dispositions','curr_dt'));
    }
}
