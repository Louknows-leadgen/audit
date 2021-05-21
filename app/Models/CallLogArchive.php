<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserEmployeeMapping;
use App\Models\CallLog;

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


    public function user_employee_mapping(){
        return $this->belongsTo('App\Models\UserEmployeeMapping','user','user_id');
    }


    public function dateformat_moddyyyy(){
        return date('F d, Y g:i A',strtotime($this->timestamp));
    }


    public function user(){
        return isset($this->user_employee_mapping->employee->full_name) ? $this->user_employee_mapping->employee->full_name : '(No record)';
    }

    public static function search_by_phone($phone){
        $call = self::where('phone_number',$phone)->first();
        if(empty($call)){
            $call = CallLog::where('phone_number',$phone)->first();
        }

        return $call;
    }

    public static function search_by_recording_id($recording_id){
       $call = self::where('recording_id',$recording_id)->first();
        if(empty($call)){
            $call = CallLog::where('recording_id',$recording_id)->first();
        }

        return $call;
    }

     public static function search_by_id($ctr){
       $call = self::find($ctr);
        if(empty($call)){
            $call = CallLog::find($ctr);
        }

        return $call;
    }


}
