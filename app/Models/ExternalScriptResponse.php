<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ExternalScriptResponse extends Model
{
    //
	protected $fillable = [
		'script_response_id',
		'external_factor_id'
	];

    public static function delete_if_not_exist($script_response_id,$collection){
    	DB::table('external_script_responses')
    	  ->where('script_response_id','=',$script_response_id)
    	  ->whereNotIn('external_factor_id',$collection)
    	  ->delete();
    }
}
