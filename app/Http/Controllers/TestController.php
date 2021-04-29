<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    public function index(){
    	return view('admin.index');
    }


	////////////////////////// HELPER FUNCTIONS ////////////////////////////////////////////////////////////

	private function generate_recording_url($recording_filename, $server_origin, $timestamp){
	    $urls = [];
	    $filename = $recording_filename;
	    $server = $server_origin;
	    $date = date('Y-m-d',strtotime($timestamp));

	    array_push($urls, ['type' => 'wav', 'url' => "http://$server/RECORDINGS/$filename-all.wav"]);
	    array_push($urls, ['type' => 'mpeg', 'url' => "http://$server/RECORDINGS/MP3/$filename-all.mp3"]);
	    array_push($urls, ['type' => 'mpeg', 'url' => "http://38.102.225.164/archive/$date/$filename-all.mp3"]);

	    $url = [];
	    foreach ($urls as $endpoint) {
	        $response = $this->check_url($endpoint['url']);
	        if($response == '200'){
	            $url = $endpoint;
	            break;
	        }
	    }

	    return $url;
	}

	private function check_url($url) {
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_HEADER, 1);
	    curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
	    $data = curl_exec($ch);
	    $headers = curl_getinfo($ch);
	    curl_close($ch);

	    return $headers['http_code'];
	}

	private function get_url_stage($recording){
		switch ($recording['type']) {
			case 'wav':
				$url_stage = 1;
				break;
			case 'mpeg':
			    if(stripos($recording['url'], 'archive')){
			    	$url_stage = 3;
			    }else{
			    	$url_stage = 2;
			    }
		}

		return $url_stage;
	}

	//////////////////////////////////////////////////////////////////////////////////////////////////////

	public function update_url(){
		$user = 'cron_calllog_to_archive';
		$pw = 'ZPT5px59';
		$host = 'localhost';
		$db = 'qa_audit';

		$conn = new mysqli($host,$user,$pw,$db);

		$q = "SELECT ctr, recording_filename, server_origin, timestamp FROM calllogs_assigned WHERE url_stage < 3";
		$result = $conn->query($q);
		$rows = $result->fetch_all(MYSQLI_ASSOC);

		foreach ($rows as $row) {
			$recording_filename = $row['recording_filename'];
			$server_origin = $row['server_origin'];
			$timestamp = $row['timestamp'];

			$recording = $this->generate_recording_url($recording_filename, $server_origin, $timestamp);
			$url_stage = $this->get_url_stage($recording);
			$recording_url = $recording['url'];
			$ctr = $row['ctr'];

			$upd_q = "UPDATE calllogs_assigned SET recording_url = '$recording_url', url_stage = $url_stage WHERE ctr = $ctr";

			$conn->query($upd_q);
		}
	}
}
