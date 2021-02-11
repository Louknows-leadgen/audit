<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamSupervisor extends Model
{
    // specify table to be used for this model (Legacy table)
    protected $table = 'team_supervisor';
    // specify primary key of the table for the legacy table
    protected $primaryKey = 'employeeid';

    
    /**********************************
    |			Association
    |**********************************/

    public function team_assignment(){
    	return $this->hasMany('App\Models\TeamAssignment','teamlead');
    }
}
