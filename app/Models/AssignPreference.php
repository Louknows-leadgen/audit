<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignPreference extends Model
{
    //

    public function assign_preference_dispositions(){
    	return $this->hasMany('App\Models\AssignPreferenceDisposition');
    }
}
