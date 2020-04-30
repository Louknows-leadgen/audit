<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CanRegister
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()) {
            $role = Auth::user()->role_id;
            // if role is not super admin or admin else proceed to next step
            if(!in_array($role,[1,2])){
              return redirect()->route('root');
            }
        }else{
            return redirect()->route('login');
        }

        return $next($request);
    }
}
