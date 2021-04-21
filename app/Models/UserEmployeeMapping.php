<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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


}
