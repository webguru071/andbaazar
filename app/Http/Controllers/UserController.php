<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function changeBusinessInfo(){
        $userServices = Auth::user()->business_types;
        return view('auth.select-service',compact('userServices'));
        // $businessTypes=Auth::user()->business_types;
        // return view('user.change-business-info',compact('businessTypes'));
    }

    public function updateBusinessInfo(Request $request){
        $user=Auth::user();
        $user->business_types = $request->business_types;
        $user->save();
        Session()->forget('default_service');
        flash('Business Info Updated Successfully')->success()->important();
        return redirect()->action('AuthController@selectDefaultService');
    }
}
