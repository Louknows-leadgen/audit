<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTeam extends Model
{
    protected $fillable = [
        'user_id',
        'team_code'
    ];

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


    /*
    |------------------------
    |     Custom Attributes
    |------------------------
    */

    // used to create custom attribute specified inside the bracket
    protected $appends = ['user_name','team'];
    
    public function getUserNameAttribute(){
        $user = User::find($this->user_id);

        return $user->name;
    }
}
