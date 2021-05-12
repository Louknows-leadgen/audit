<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::user();
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
            // return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
