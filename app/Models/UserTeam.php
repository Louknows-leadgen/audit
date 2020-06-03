<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTeam extends Model
{
    /*
    |-------------------------
    |		Association
    |-------------------------*/

    public function users(){
    	return $this->belongsTo('App\Models\User');
    }

    public function teams(){
    	return $this->belongsTo('App\Models\Team','team_code','code');
    }
}
