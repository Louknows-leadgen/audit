<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecordingScript extends Model
{
    //
    /*
    |----------------------------------
    |        Association
    |----------------------------------*/

    public function script(){
        return $this->belongsTo('App\Models\Script','script_code','code');
    }


    /*
    |--------------------
    |	Helpers
    |--------------------*/

    public static function is_uniq_response($script_id, $recording_id){
    	return !self::where('recording_id','=',$recording_id)
    			   ->where('script_code','=',$script_id)
    			   ->exists();
    }

    public static function find_by_composite_ids($script_code, $recording_id){
        return self::where('recording_id','=',$recording_id)
                   ->where('script_code','=',$script_code)
                   ->first();
    }
}
