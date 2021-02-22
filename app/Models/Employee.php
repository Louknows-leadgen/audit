<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

	// specify primary key of the table for the legacy table
    protected $primaryKey = 'employeeid';


    /**********************************
    |			Association
    |**********************************/
    
    public function user_employee_mapping(){
    	return $this->hasOne('App\Models\UserEmployeeMapping','employeeid');
    }


    /*
    |-------------------------------------
    |           Custom Attributes
    |-------------------------------------*/

    protected $appends = ['full_name'];

    public function getFullNameAttribute(){
        return $this->firstname . ' ' . $this->lastname;
    }

}
