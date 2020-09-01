<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Finding extends Model
{
    protected $fillable = [
    	'recording_id',
    	'qa_remarks'
    ];


    /*
    |--------------------------------
    |          Association
    |--------------------------------*/

    public function call_log(){
    	return $this->belongsTo('App\Models\CallLog','recording_id','recording_id');
    }
}
