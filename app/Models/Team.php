<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /*
    |-----------------------------
    |		Association
    |-----------------------------*/

    public function user_teams(){
        return $this->hasMany('App\Models\UserTeam');
    }
}
