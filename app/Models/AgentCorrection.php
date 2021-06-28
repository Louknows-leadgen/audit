<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentCorrection extends Model
{
    /*
    |-------------------------------------
    |			Associations
    |-------------------------------------*/
    
    public function agent_script_responses(){
    	return $this->hasMany('App\Models\AgentScriptResponse');
    }

    public function ops_agent_script_responses(){
    	return $this->hasMany('App\Models\OpsAgentScriptResponse');
    }
}
