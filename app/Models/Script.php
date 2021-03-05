<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Script extends Model
{
    
    /*
    |----------------------------------
    |        Association
    |----------------------------------*/

    public function recording_scripts(){
    	return $this->hasMany('App\Models\RecordingScript','script_code','code');
    }

    public function script_responses(){
    	return $this->hasMany('App\Models\ScriptResponse');
    }

}
