<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IncidentReportController extends Controller
{
    //
    public function __construct(){
		$this->middleware('checkrole:4');
	}

	public function form(Request $request){
		return view('incident_report.form');
	}
}
