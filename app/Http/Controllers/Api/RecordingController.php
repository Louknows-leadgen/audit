<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecordingController extends Controller
{
    //
    public function recording_url($server_origin, $date, $filename){
		$urls = (object)[
			'wav' => "http://$server_origin/RECORDINGS/$filename-all.wav",
			'mp3' => "http://$server_origin/RECORDINGS/MP3/$filename-all.mp3",
			'arch' => "http://38.102.225.164/archive/${date}/$filename-all.mp3"
		];

		// return view('api.recording.recording_url',compact('urls'));

		return view('api.recording.recording_url',compact('urls'));
    }


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

	    // return $headers['http_code'];
	    return response()->json($url_meta);
	}
}
