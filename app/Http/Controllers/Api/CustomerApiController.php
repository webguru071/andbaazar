<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sentinel;
use Baazar;
class CustomerApiController extends Controller
{
    public function registration(Request $request){
        $data = [
		    'first_name'=> $request->first_name,
		    'last_name' => $request->last_name,
		    'email' 	=> $request->email,
		    'password' 	=> $request->password,
		    'type' 	    => 'customers',
		];
        $customer = Sentinel::registerAndActivate($data);
        // dd($customer);
        if(!$customer){
            return response()->json(['data' => '','error' => true,'message' => 'User can\'t register']);
        }
        $accessToken = $customer->createToken('authToken')->accessToken;

        return response()->json(['data' => [
            'user'  => $customer,
            'token' => $accessToken
        ],'error' => false,'message' => 'user registeration success']);
    }

    public function login(Request $request){
        $credentials = [
			'email'		=> $request->email,
			'password'	=> $request->password,
			'type'	    => 'customers',
		];
		$user = Sentinel::authenticate($credentials);
        
        if($user){
            $accessToken = $user->createToken('authToken')->accessToken;
            return Baazar::apiSuccess(['user' => $user,'token' => $accessToken],'Login Successfully');
        }else{
            return Baazar::apiError('Login Unsuccessfully');
            // return redirect('login')->with('error', 'Invalid email or password');
        }
    }
}
