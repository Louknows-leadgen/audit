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
}
