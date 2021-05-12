<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login. Refer to custom functions below instead
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /*
    |----------------------------------
    |         Custom Functions
    |----------------------------------*/

    // function used to redirect user when logged in
    protected function authenticated(Request $request, $user)
    {
        switch ($user->role_id) {
            case 1:
                return redirect()->route('root');
            case 2:
                return redirect()->route('admin.index');
            case 3:
                return redirect()->route('supervisor.index');
            case 4:
                return redirect()->route('auditor.index');
            case 5:
                return redirect()->route('ops.index');  
        }
    }
}
