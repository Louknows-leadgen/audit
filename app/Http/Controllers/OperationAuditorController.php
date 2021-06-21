<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\CallLogsAssigned;
use App\Models\UserEmployeeMapping;


class OperationAuditorController extends Controller
{
	public function __construct(){
		$this->middleware('checkrole:5');
	}

    //
    public function index(){
    	$calllogs = CallLogsAssigned::audited_logs();

		return view('ops_auditor.index',compact('calllogs'));
    }


    public function audited($recording_id){
        $calllog = CallLogsAssigned::where('recording_id','=',$recording_id)->first();

        // $server = $calllog->server_ip;
        $user_id = $calllog->user;
        $audit_type = $calllog->audit_type;
        $emp = UserEmployeeMapping::firstWhere('user_id',$user_id);
        // $recording_file = ['type' => $this->get_filetype($calllog->recording_url), 'url' => $calllog->recording_url];
        $recording = $this->generate_recording_url($calllog);
        if(!empty($recording)){
            $recording_file = $recording;
            if($calllog->recording_url != $recording['url']){
                $calllog->recording_url = $recording['url'];
                // $calllog->url_stage = $this->get_url_stage($recording);
                $calllog->save();
            }
        }else{
            $recording_file = ['type' => 'wav', 'url' => $calllog->recording_url];
        }

        return view('ops_auditor.audited',compact('calllog','emp','user_id','recording_file','audit_type'));
    }


    public function search(Request $request){
        $searchtxt = $request->searchtxt;
        $searchtype = $request->type;

        switch ($request->type) {
            case 'record_id':
                // recording id scope
                $calls = CallLogsAssigned::whereLike('recording_id',$searchtxt)->paginate(10);
                break; 
            case 'recording_date':
                // recording id scope
                $calls = CallLogsAssigned::whereDateEqual('timestamp',$searchtxt)->paginate(10);  
                break; 
            case 'agent_id':
                // recording id scope
                $calls = CallLogsAssigned::whereLike('user',$searchtxt)->paginate(10);  
                break;        
            default:
                # code...
                break;
        }

         return view('ops_auditor.search',compact('calls','searchtxt','searchtype'));
    }



    private function get_filetype($url){
        if(stripos($url, '.mp3')){
            return 'mpeg';
        }

        return 'wav';
    }

    private function generate_recording_url($calllog){
        $urls = [];
        $filename = $calllog->recording_filename;
        $server = $calllog->server_origin;
        $date = date('Y-m-d',strtotime($calllog->timestamp));

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
}
