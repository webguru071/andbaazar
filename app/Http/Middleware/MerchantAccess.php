<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class MerchantAccess
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
        if (Auth::user()->type == 'merchant' || Auth::user()->type == 'admin') {
            return $next($request);
        }
        return redirect('/merchant/login');//->with('error','Sorry you are not loggedin.');
    }
}
