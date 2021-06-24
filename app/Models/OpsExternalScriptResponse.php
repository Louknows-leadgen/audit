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
}
