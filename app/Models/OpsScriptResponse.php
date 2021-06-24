<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpsScriptResponse extends Model
{
    //
    protected $fillable = [
    	'recording_id',
    	'script_id',
    	'cust_statement',
    	'aud_comment',
    	'inc_tagging',
    	'inapp_resp',
    	'inc_detail'
    ];
}
