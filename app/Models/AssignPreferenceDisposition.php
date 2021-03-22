<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignPreferenceDisposition extends Model
{
    //
    public function assign_preference(){
    	return $this->belongsTo('App\Models\AssignPreference');
    }
}
