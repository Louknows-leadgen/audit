<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignPreferenceDisposition extends Model
{
	protected $fillable = [
		'count'
	];


    //
    public function assign_preference(){
    	return $this->belongsTo('App\Models\AssignPreference');
    }
}
