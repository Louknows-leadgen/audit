<?php

function date_locale($date,$format='m/d/Y'){
	date_default_timezone_set('Asia/Kuala_Lumpur');
	return format_date($date,$format);
}

function format_date($date,$format='m/d/Y'){
	return date_format(date_create($date),$format);
}

function return_col_val($col,$default=''){
	return isset($col) ? $col : $default;
}

function get_recording_location($recording_id,$server){
	$curl_conn = curl_init("http://$server/api/get_recording_location.php?recording_id=$recording_id");
	curl_setopt($curl_conn, CURLOPT_RETURNTRANSFER, true);
	$json = '';
	if(($json = curl_exec($curl_conn)) === false){
		$empty = '';
		$json = json_encode($empty);
	}

	// Converts it into a PHP object
	$data = json_decode($json);
	return $data;
}


use App\Models\ScriptResponse;

function get_responses($recording_id,$script_id){
	return ScriptResponse::responses($recording_id,$script_id);
}