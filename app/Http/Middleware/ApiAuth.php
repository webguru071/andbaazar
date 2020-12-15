<?php

namespace App\Http\Middleware;

use Closure;
use Baazar;
use App\User;
class ApiAuth
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
    if($request->header('Authorization')){
        $auth = User::where('api_token',$request->header('Authorization'))->count();
        if($auth > 0){
            return $next($request);
        }else{
            return Baazar::apiError('Unauthenticate');
        }
    }
    return Baazar::apiError('Unauthenticate');
    // return response()->json([
    //     'message' => 'Not a valid API request.',
    // ]);
    }
}
