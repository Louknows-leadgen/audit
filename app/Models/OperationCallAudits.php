<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OperationCallAudits extends Model
{
    public static function scopeIsNotAudited($query, $ctr, $user){
    	return $query->where('ctr',$ctr)
    	             ->where('ops_user',$user)
    	             ->get();
    }
}
