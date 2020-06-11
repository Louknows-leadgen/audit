<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecordingLog extends Model
{
    // specify table to be used for this model (Legacy table)
    protected $table = 'recording_log';

    // specify primary key of the table for the legacy table
    protected $primaryKey = 'recording_id';

    // remove auto increment for the primary key
    public $incrementing = false;


    
}
