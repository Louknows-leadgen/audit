<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallLogArchive extends Model
{
    // specify table to be used for this model (Legacy table)
    protected $table = 'calllogs_archive_search';
    // specify primary key of the table for the legacy table
    protected $primaryKey = 'ctr';


    public function script_responses(){
        return $this->hasMany('App\Models\ScriptResponse','recording_id','recording_id');
    }

    public function auditor(){
        return $this->belongsTo('App\Models\User','claimed_by');
    }


    // Scopes
    public function scopeDistinctDispo($query){
        return $query->distinct()->orderBy('dispo','asc')->get('dispo');
    }

    public function scopeWhereBetweenDates($query, $col, $from = null, $to = null){
        if(empty($from) || empty($to)){
            date_default_timezone_set('America/New_York');
            $currdt = date('Y-m-d');
            $from = date('Y-m-d',strtotime($currdt . ' -2 days'));
            $to = date('Y-m-d',strtotime($currdt . ' -1 days'));
        }

        return $query->where($col,'>=', $from)
                     ->where($col,'<', $to);
    }

    public function scopeWhereDispoIn($query, $dispo = []){
        if(empty($dispo))
            return $query;
        
        return $query->whereIn('dispo',$dispo);
    }

    public function scopeWhereUserIs($query, $user = null){
        if(empty($user))
            return $query;

        return $query->where('user',$user);
    }
}
