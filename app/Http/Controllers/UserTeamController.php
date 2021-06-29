<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserTeam;
use App\Models\CallLogsAssigned;

class UserTeamController extends Controller
{
    //
    public function store(Request $request){
    	$user_id = $request->user_id;
    	$team_code = $request->team_code;

    	$user_team = new UserTeam;
    	$user_team->user_id = $user_id;
    	$user_team->team_code = $team_code;
    	$user_team->save();
    }

    public function destroy($user_team_id){
    	$user_team = UserTeam::find($user_team_id);

    	CallLogsAssigned::release_user_calls($user_team->user_id,$user_team_id);
    	$user_team->delete();
    }   
}
