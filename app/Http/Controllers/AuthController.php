<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller{

    public function userLogin(){
        if (Auth::check()){
            switch (Auth::user()->type) {
                case "admin":
                    return redirect('andbaazaradmin/dashboard');
                case "merchant":
                    return redirect('merchant/dashboard');
                default:
                    return redirect('/');
            }
        }
        else{
            return view('auth.login');
        }
    }

    public function userAuth(Request $request){
        $credentials = $request->only('email', 'password');
        $user = Auth::attempt($credentials, $request->remember_me);

        if($user){
            switch (Auth::user()->type) {
                case "admin":
                    return redirect('andbaazaradmin/dashboard');
                case "merchant":
                    return redirect('merchant/dashboard');
                default:
                    Auth::logout();
                    return redirect('/');
            }
        }
        else
            flash('Invalid username or password')->error();
            return view('auth.login');
    }

	public function adminlogin(){
		if (!Auth::check())
			return view('auth.admin.login');
		else
			return redirect('andbaazaradmin/dashboard');
	}

	public function adminloginprocess(Request $request){
		$credentials = [
			'email'		=> $request->login['email'],
			'password'	=> $request->login['password'],
			'type'		=> 'admin'
		];

		if($request->remember == 'on')
			$user = Auth::attempt($credentials, true);
		else
			$user = Auth::attempt($credentials);

		if($user)
			return redirect('andbaazaradmin/dashboard');
		else
			return redirect('andbaazaradmin/login')->with('error', 'Invalid email or password');
	}

	public function logout(){
		Auth::logout();
		return redirect('/login');
	}
}
