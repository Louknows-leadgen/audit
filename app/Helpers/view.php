<?php

use App\Models\RecordingScript;

function get_recording_script($script_code, $recording_id){
	$rs = RecordingScript::find_by_composite_ids($script_code, $recording_id);

	return $rs;
}

function date_locale($date,$format='m/d/Y'){
	date_default_timezone_set('Asia/Kuala_Lumpur');
	return format_date($date,$format);
}

function format_date($date,$format='m/d/Y'){
	return date_format(date_create($date),$format);
}