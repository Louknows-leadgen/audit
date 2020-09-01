<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FindingIssue extends Model
{
    //
    protected $fillable = [
    	'finding_id',
    	'agent_system_issue_id'
    ];
}
