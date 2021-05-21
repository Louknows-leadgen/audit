<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OpsAgentScriptResponse extends Model
{
	//
    protected $fillable = [
    	'ops_script_response_id',
    	'agent_correction_id'
    ];

    /************************************************
    |               Association
    *************************************************/
    public function script_response(){
        return $this->belongsTo('App\Models\OpsScriptResponse');
    }

    public function agent_correction(){
        return $this->belongsTo('App\Models\AgentCorrection');
    }


    public static function delete_if_not_exist($ops_script_response_id,$collection){
    	DB::table('ops_agent_script_responses')
    	  ->where('ops_script_response_id','=',$ops_script_response_id)
    	  ->whereNotIn('agent_correction_id',$collection)
    	  ->delete();
    }
}
