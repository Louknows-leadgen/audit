<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecordingScript extends Model
{
    //


    /*
    |--------------------
    |	Helpers
    |--------------------*/

    public static function is_uniq_response($script_id, $recording_id){
    	return !self::where('recording_id','=',$recording_id)
    			   ->where('script_code','=',$script_id)
    			   ->exists();
    }
}
