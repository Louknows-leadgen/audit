<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roleid)
    {
        if(Auth::check()) {
            $role = Auth::user()->role_id;
            if($role != $roleid){
                switch ($role) {
                    case 1:
                        return redirect()->route('root');
                        break;
                    case 2:
                        return redirect()->route('admin.index');
                        break;
                    
                    case 3:
                        return redirect()->route('supervisor.index');
                        break;
                    case 4:
                        return redirect()->route('auditor.index');
                        break;
                    case 5:
                        return redirect()->route('ops.index');
                }
            }
        }else{
            return redirect()->route('login');
        }

        return $next($request);
    }
}
