<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isActive
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
        if (Auth::guard('api')->check() && Auth::user()->status==1){
            return $next($request);
        }
        else{
            $request->user()->token()->revoke();
            return response()->json(['status' => 'Unauthorized'], 401);
        }

    }
}
