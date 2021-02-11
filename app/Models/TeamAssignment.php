<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamAssignment extends Model
{
    // specify table to be used for this model (Legacy table)
    protected $table = 'teamassignment';
    // specify primary key of the table for the legacy table
    protected $primaryKey = 'id';

    /**********************************
    |			Association
    |**********************************/

    public function user_employee_mapping(){
    	return $this->belongsTo('App\Models\UserEmployeeMapping','employeeid');
    }

    public function team_supervisor(){
    	return $this->belongsTo('App\Models\TeamSupervisor','teamlead');
    }
}
