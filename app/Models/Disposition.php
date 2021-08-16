<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disposition extends Model
{
    //

    // public static function all_dispo(){
    // 	return self::select('short_name as dispo')->orderBy('short_name','asc')->get();
    // }

    public function scopeAllDispo($query){
        return $query->select('short_name as dispo')->orderBy('short_name','asc')->get();
    }
}