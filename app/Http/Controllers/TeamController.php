<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Team;
use App\Models\User;
use App\Models\CallLogsAssigned;
use DB;

class TeamController extends Controller
{
    //
	public function store(Request $request){
		$request->validate([
			'name' => ['required','unique:teams']
		]);

		$team = Team::create([
					'name' => $request->name,
					'short_desc' => $request->short_desc
				]);
		$team->code = $team->id;
		$team->save();

		return redirect()->route('supervisor.manage_teams')
		                 ->with('success','Created new team');
	}

    public function show($team_id){
    	$team = Team::find($team_id);
    	$avail_users = User::no_team_users();

    	return view('team.show',compact('team','avail_users'));
    }

    public function update($team_id, Request $request){

    	$request->validate([
    		'name' => ['bail','required','unique:teams,code,'.$team_id]
    	]);

    	$team = Team::find($team_id);
    	$team->name = $request->name;
    	$team->short_desc = $request->short_desc;
    	$team->save();

    	return redirect()->route('teams.show',['team' => $team->code])
    					 ->with('success','Team\'s information has been updated');
    }

    public function destroy($team_id){
    	$team = Team::find($team_id); 	

    	// remove all responses from the recordings assigned by the calls assigned by that team and set them to available again
    	CallLogsAssigned::release_calls($team_id);

    	// unassign users from the team
    	foreach ($team->user_teams as $user) {
    		$user->delete();
    	}

    	// remove the team itself
    	$team->delete();

    	//session(['success'=>'Removed a team']);
    	Session::flash('success','Removed a team');
    }

}
