<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserList extends Model
{
    // specify table to be used for this model (Legacy table)
    protected $table = 'userlist';
    // specify primary key of the table for the legacy table
    protected $primaryKey = 'user';
    // tell laravel that the primary key is not incrementing
    public $incrementing = false;
    // tell laravel that the primary key is not an integer
    protected $keyType = 'string';

    /*
    |-------------------------------------
    |			Associations
    |-------------------------------------*/

    public function call_logs(){
    	return $this->hasMany('App\Models\CallLog','user','user');
    }
}
