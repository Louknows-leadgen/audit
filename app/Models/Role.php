<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /*
    |----------------------------
    |     Model Association
    |----------------------------*/

    public function users(){
        return $this->hasMany('App\Models\User','role_id','uniqid');
    }
}
