<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AgentScriptResponse extends Model
{
    //
    protected $fillable = [
    	'script_response_id',
    	'agent_correction_id'
    ];

    /************************************************
    |               Association
    *************************************************/
    public function script_response(){
        return $this->belongsTo('App\Models\ScriptResponse');
    }

    public function agent_correction(){
        return $this->belongsTo('App\Models\AgentCorrection');
    }

    /**************************************************/

    public static function delete_if_not_exist($script_response_id,$collection){
    	DB::table('agent_script_responses')
    	  ->where('script_response_id','=',$script_response_id)
    	  ->whereNotIn('agent_correction_id',$collection)
    	  ->delete();
    }
}
