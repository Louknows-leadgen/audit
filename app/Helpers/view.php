<?php

use App\Models\RecordingScript;

function get_recording_script($script_code, $recording_id){
	$rs = RecordingScript::find_by_composite_ids($script_code, $recording_id);

	return $rs;
}