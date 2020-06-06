<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
	// specify custom primary key of the table
    // protected $primaryKey = 'code';

    protected $fillable = [
    	'name',
    	'short_desc',
    	'code'
    ];

    /*
    |-----------------------------
    |		Association
    |-----------------------------*/

    public function user_teams(){
        return $this->hasMany('App\Models\UserTeam','team_code','code');
    }
}
