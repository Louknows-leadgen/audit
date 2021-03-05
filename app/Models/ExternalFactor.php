<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExternalFactor extends Model
{
    /*
    |-------------------------------------
    |			Associations
    |-------------------------------------*/
    
    public function agent_script_responses(){
    	return $this->hasMany('App\Models\ExternalScriptResponse');
    }
}
