<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallLogArchive extends Model
{
    // specify table to be used for this model (Legacy table)
    protected $table = 'calllogs_archive';
    // specify primary key of the table for the legacy table
    protected $primaryKey = 'ctr';


    public function script_responses(){
        return $this->hasMany('App\Models\ScriptResponse','recording_id','recording_id');
    }
}
