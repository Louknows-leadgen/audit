<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpsScriptResponse extends Model
{
    //
    protected $fillable = [
    	'ctr',
    	'script_id',
    	'cust_statement',
    	'aud_comment',
    	'inc_tagging',
    	'inapp_resp',
    	'inc_detail'
    ];


    /*
    |-------------------------------------
    |           Associations
    |-------------------------------------*/

    public function operation_call_audit(){
        return $this->belongsTo('App\Models\OperationCallAudits','ctr','ctr');
    }

    public function ops_agent_script_responses(){
        return $this->hasMany('App\Models\OpsAgentScriptResponse');
    }

    public function ops_external_script_responses(){
        return $this->hasMany('App\Models\OpsExternalScriptResponse');
    }

    public function script(){
        return $this->belongsTo('App\Models\Script');
    }


    
    // Helpers


    public function deleteOpsScriptResponse(){
        $ops_script_response = $this;
        if($ops_script_response->delete()){
            foreach ($ops_script_response->ops_agent_script_responses as $ops_agent_script_response){
                $ops_agent_script_response->deleteOpsAgentScriptResponse();
            }

            foreach ($ops_script_response->ops_external_script_responses as $ops_external_script_response){
                $ops_external_script_response->deleteOpsExternalScriptResponse();
            }
        }
    }
}
