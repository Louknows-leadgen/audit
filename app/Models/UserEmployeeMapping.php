<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;

class UserEmployeeMapping extends Model
{
    // specify table to be used for this model (Legacy table)
    protected $table = 'user_employee_mapping';
    // specify primary key of the table for the legacy table
    protected $primaryKey = 'employeeid';

    
    /**********************************
    |			Association
    |**********************************/
    
    public function team_assignment(){
    	return $this->hasOne('App\Models\TeamAssignment','employeeid');
    }

    public function employee(){
        return $this->belongsTo('App\Models\Employee','employeeid');
    }

    /**********************************
    |          Custom methods
    |**********************************/

    /*
    |-------------------------------------
    |           Custom Attributes
    |-------------------------------------*/

    protected $appends = ['team_lead'];

    public function getTeamLeadAttribute(){
        $tlid = $this->tl_employeeid;

        $team_lead = Employee::find($tlid);

        return $team_lead;
    }
}
