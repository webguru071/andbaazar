<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use App\Models\Shop;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller{

    public function userLogin(){
        if (Auth::check()){
            return redirect()->action('AuthController@selectDefaultService');
        }
        else{
             return view('auth.login');
        }
    }

    public function userAuth(Request $request){
        $request->validate([
            'userName' => 'required',
            'password'   => 'required'
        ]);

        $credentials = [];

        if(is_numeric($request->userName)){
            $credentials= ['phone'=>$request->userName,'password'=>$request->password];
        }
        elseif (filter_var($request->userName, FILTER_VALIDATE_EMAIL)) {
            $credentials= ['email'=>$request->userName, 'password'=>$request->password];
        }

        $user = Auth::attempt($credentials, $request->remember_me);

        if($user){
            return redirect()->action('AuthController@selectDefaultService');
        }
        else
            flash('Invalid username or password')->error();
            return redirect()->back();
            // return view('auth.merchant.login');
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

	public function userProfile(){
        $userprofile = Auth::user();
        $sellerProfile = Merchant::where('user_id',$userprofile->id)->first();
        $shopProfile = Shop::where('user_id',$userprofile->id)->first();
        return  view('auth.profile',compact('sellerProfile','userprofile','shopProfile'));
    }

	public function logout(){
		Auth::logout();
		Session::flush();
		return redirect('/login');
	}

	public function adminLogout(){
        Auth::logout();
        Session::flush();
        return redirect('/andbaazaradmin/login');
    }

    public function selectDefaultService(){
        $user= Auth::user();
        $userServices = $user->business_types;
        if (count($userServices)<=0){
            return redirect()->action('AuthController@selectBusinessInfo');
        }
        elseif (count($userServices)<=1){
            $user->login_area= $userServices[0];
            $user->save();
            $redirectURL=$this->redirectAuthUser();
            return redirect($redirectURL);
        }
        else{
            return view('auth.select-service',compact('userServices'));
        }
    }

	public function setDefaultService(Request $request){
        $user= Auth::user();
        $user->login_area=$request->selected_service;
        $user->save();
        session(['default_service' => $request->selected_service]);
        $redirectURL=$this->redirectAuthUser();
        return redirect($redirectURL);
    }

    public function redirectAuthUser(){
        $redirectUrl='/';
        switch (Auth::user()->type) {
            case "admin":
                $redirectUrl = '/andbaazaradmin/dashboard';
                break;
            case "merchant":
                $redirectUrl = '/merchant/dashboard';
                break;
            default:
                Auth::logout();
        }
        return $redirectUrl;
    }

    public function selectBusinessInfo(){
        return view('auth.select-service');
    }

    public function updateBusinessInfo(Request $request){
        $user = Auth::user();
        $user->business_types = $request->business_types;
        $user->save();
        return redirect()->action('AuthController@selectDefaultService');
    }
}
