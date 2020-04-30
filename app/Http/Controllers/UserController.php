<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use App\Models\User;

class UserController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

	public function index(){
		$user = Auth::user();
		return view('user.index',compact('user'));
	}

    public function update_account(Request $request){
        $user = Auth::user();

    	$validator = Validator::make($request->all(),[
    		'email' => 'required|unique:users,email,'. $user->id,
            'name' => 'required'
    	]);

    	if($validator->fails()){
    		return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
    	}

    	if($user->update($validator->validated()))
            return response()->json(['success'=>'<strong>Success!</strong> Account updated']);
        else
            return response()->json(['fail'=>'<strong>Failed!</strong> Something went wrong'])->setStatusCode(500);
    }


    public function update_password(Request $request){
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'confirm_password' => ['same:new_password']
        ],[
            'current_password.required' => 'Current password is required.',
            'new_password.required' => 'New password is required.',
            'confirm_password.same' => 'Confirm and new password does not match.'
        ]);

        if ($validator->fails()){
            return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }

        
        if($user->update(['password'=> Hash::make($request->new_password)]))
            return response()->json(['success'=>'<strong>Success!</strong> Password has been updated']);
        else
            return response()->json(['fail'=>'<strong>Failed!</strong> Something went wrong'])->setStatusCode(500);
    }
}
