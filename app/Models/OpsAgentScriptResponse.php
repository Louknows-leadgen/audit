<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpsAgentScriptResponse extends Model
{
    //
    protected $fillable = [
    	'ops_script_response_id',
    	'agent_correction_id'
    ];

    /*
    |-------------------------------------
    |           Associations
    |-------------------------------------*/

    public function ops_script_response(){
        return $this->belongsTo('App\Models\OpsScriptResponse');
    }

    public function agent_correction(){
        return $this->belongsTo('App\Models\AgentCorrection');
    }


    // Helper
    public function deleteOpsAgentScriptResponse(){
    	$this->delete();
    }
}
