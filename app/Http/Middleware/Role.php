<?php

namespace App\Http\Middleware;


use Illuminate\Http\Request;

use Closure;
use Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // if(!auth()->check()){
        //     abort(403);
        // }
        // return $next($request);
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if (Auth::user()->role == $role) {
                    return $next($request);
                }
            }
            return abort(401, 'Unauthorized');
        }
    }
    
}
