<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpsExternalScriptResponse extends Model
{
    //
    protected $fillable = [
		'ops_script_response_id',
		'external_factor_id'
	];


	/*
    |-------------------------------------
    |           Associations
    |-------------------------------------*/

    public function ops_script_response(){
        return $this->belongsTo('App\Models\OpsScriptResponse');
    }

    public function external_factor(){
        return $this->belongsTo('App\Models\ExternalFactor');
    }


    // Helper
    public function deleteOpsExternalScriptResponse(){
    	$this->delete();
    }
}
