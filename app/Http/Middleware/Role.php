<?php

namespace App\Http\Middleware;


use Illuminate\Http\Request;

use Closure;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!auth()->check()){
            abort(403);
        }
        return $next($request);
        }
    
}
