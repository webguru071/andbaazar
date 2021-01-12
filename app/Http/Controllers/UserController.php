<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

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

    public function verifyEmailAddress($userID, $verificationCode){
        $validator=Validator::make(['userID'=>$userID, 'verificationCode'=>$verificationCode], [
            'userID'=>'required|numeric',
            'verificationCode'=>'required|string'
        ]);

        if ($validator->fails()){
            flash($validator->messages()->first())->error();
            return redirect('/');
        }
        $verifyEmail = User::where([['id',$userID],['email_verification_code',$verificationCode]])->where('email_verification_code_expired_at','>',Carbon::now())->first();
        if (is_null($verifyEmail)){
            flash('Invalid verification link')->error();
            return redirect('/');
        }
        else{
            $verifyEmail->email_verified_at = Carbon::now();
            $verifyEmail->save();
            flash('Email verified successfully')->success();
            return redirect('/');
        }
    }
}
