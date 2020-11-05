<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScriptResponse extends Model
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

    public static function responses($recording_id,$script_id){
        return self::where('recording_id','=',$recording_id)
                   ->where('script_id','=',$script_id)
                   ->first();
    }
}
