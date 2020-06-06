<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /*
    |----------------------------
    |     Model Association
    |----------------------------*/

    public function role(){
        return $this->belongsTo('App\Models\Role','role_id','uniqid');
    }

    public function user_teams(){
        return $this->hasMany('App\Models\UserTeam');
    }

    public function call_logs(){
        return $this->hasMany('App\Models\CallLog','claimed_by');
    }


    /*
    |----------------------------
    |    Helpers
    |----------------------------*/

    public static function no_team_users(){
        $query = DB::table('users as u')
                   ->leftjoin('user_teams as ut','ut.user_id','=','u.id')
                   ->where('u.role_id','=',4)
                   ->whereNull('ut.user_id')
                   ->get(['u.id','u.name','u.email']);

        return $query;
    }
}
