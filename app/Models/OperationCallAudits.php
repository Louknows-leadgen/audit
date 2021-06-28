<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OperationCallAudits extends Model
{

	protected $fillable = [
		'ctr',
		'timestamp',
		'user',
		'user_group',
		'audit_type',
		'phone_number',
		'recording_id',
		'recording_filename',
		'recording_url',
		'server_ip',
		'server_origin',
		'campaign',
		'dispo',
		'talk_time',
		'server_source',
		'team_code',
		'is_claimed',
		'claimed_by',
		'status',
		'ops_user'
	];


	/*
    |-------------------------------------
    |			Associations
    |-------------------------------------*/

    public function ops_script_responses(){
        return $this->hasMany('App\Models\OpsScriptResponse','ctr','ctr');
    }


   // Scopes

    public static function scopeIsNotAudited($query, $ctr){
    	return $query->where('ctr',$ctr)->get()->count()  > 0 ? false : true;
    }

    public static function scopeMyAudits($query,$value){
    	return $query->where('ops_user',$value);
    }


    // Helpers
    public static function insertToOperationCallAudits($call){
    	$audit = self::create([
					    'ctr' => $call['ctr'],
						'timestamp' => $call['timestamp'],
						'user' => $call['user'],
						'user_group' => $call['user_group'],
						'audit_type' => $call['audit_type'],
						'phone_number' => $call['phone_number'],
						'recording_id' => $call['recording_id'],
						'recording_filename' => $call['recording_filename'],
						'recording_url' => $call['recording_url'],
						'server_ip' => $call['server_ip'],
						'server_origin' => $call['server_origin'],
						'campaign' => $call['campaign'],
						'dispo' => $call['dispo'],
						'talk_time' => $call['talk_time'],
						'server_source' => $call['server_source'],
						'team_code' => $call['team_code'],
						'is_claimed' => $call['is_claimed'],
						'claimed_by' => $call['claimed_by'],
						'status' => $call['status'],
						'ops_user' => $call['ops_user']
				 ]);

    	return $audit;
    }

    public function deleteCallAudit(){
    	$call_audit = $this;
    	if($call_audit->delete()){
    		foreach ($call_audit->ops_script_responses as $ops_script_response){
    			$ops_script_response->deleteOpsScriptResponse();
    		}
    	}
    }
}
