<?php

use App\Models\RecordingScript;

function get_recording_script($script_code, $recording_id){
	$rs = RecordingScript::find_by_composite_ids($script_code, $recording_id);

	if(!isset($rs)){
		$rs = new RecordingScript;
	}

	return $rs;
}

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

function get_recording_location($recording_id){
	$json = file_get_contents("http://38.107.183.5/api/get_recording_location.php?recording_id=$recording_id");
	// Converts it into a PHP object
	$data = json_decode($json);
	return $data;
}