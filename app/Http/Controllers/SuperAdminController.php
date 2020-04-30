<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
	public function __construct(){
		$this->middleware('checkrole:1');
	}

    //
    public function index(){
    	return view('suadmin.index');
    }
}
