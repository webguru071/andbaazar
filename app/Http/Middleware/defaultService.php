<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class defaultService
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
        if (session()->has('default_service')){
            return $next($request);
        }
        else{
            $previous_selected_service=Auth::user()->login_area;
            if (!is_null($previous_selected_service)){
                session(['default_service' => $previous_selected_service]);
                return $next($request);
            }
            else{
                return redirect()->action('AuthController@selectDefaultService');
            }
        }
    }
}
