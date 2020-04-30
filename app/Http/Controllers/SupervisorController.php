<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CallLog;

class SupervisorController extends Controller
{
    //
    public function index(){
    	$calllogs = CallLog::all();
    	return view('supervisor.index',compact('calllogs'));
    }
}
