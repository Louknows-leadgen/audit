<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignPreference extends Model
{
    //

    public function assign_preference_dispositions(){
    	return $this->hasMany('App\Models\AssignPreferenceDisposition');
    }

    public function created_by_user(){
    	return $this->belongsTo('App\Models\User','created_by');
    }

    public function updated_by_user(){
    	return $this->belongsTo('App\Models\User','updated_by');
    }
}
