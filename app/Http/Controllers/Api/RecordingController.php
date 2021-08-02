<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Api\Recording;

class RecordingController extends Controller
{
    
	public function check_url(Request $request) {
		$url = trim($request->url);
		$path_parts = pathinfo($url);
		$type = $path_parts['extension'];

	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_HEADER, 1);
	    curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,45);
	    curl_setopt($ch,CURLOPT_TIMEOUT,45);
	    $data = curl_exec($ch);
	    $headers = curl_getinfo($ch);
	    curl_close($ch);

	    $url_meta = [
	    	'url' => $url,
	    	'type' => $type,
	    	'http_code' => $headers['http_code']
	    ];

	    return response()->json($url_meta);
	}


	// public function hangup_reason(Request $request){
		
	// }
}
