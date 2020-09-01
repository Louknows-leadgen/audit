<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FindingDisposition extends Model
{
    //
    protected $fillable = [
    	'finding_id',
    	'disposition_id'
    ];
}
