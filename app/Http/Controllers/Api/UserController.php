<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\AgentProfile;
use App\Models\CustomerProfile;
use App\Models\MerchantProfile;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //    For user registration
    public function registration(Request $request){
        $validator=Validator::make($request->all(), [
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'email'=>'email|unique:users',
            'phone'=>'required|unique:users,phone|min:11|max:11',
            'password'=>'required|string',
            'user_type' => [
                'required',
                Rule::in(['customer', 'merchant', 'agent']),
            ],
        ]);

        if ($validator->fails()){
            return response()->json($validator->messages()->first(), 422);
        }
        $allData=$request->all();
        $allData['password']=Hash::make($request->password);
        $allData['type']=$request->user_type;
        $user=User::create($allData);
        $allData['user_id']=$user->id;
        switch ($request->user_type) {
            case "customer":
                CustomerProfile::create($allData);
                break;
            case "merchant":
                MerchantProfile::create($allData);
                break;
            case "agent":
                AgentProfile::create($allData);
                break;
        }

        return response()->json([
            'data'=>[
                'status'=>'success'
            ]
        ]);
    }

    //    Forget Password
    public function forgetPassword(Request $request){
        $validator=Validator::make($request->all(), [
            'phone'=>'required|numeric|exists:customers,phone',
        ]);

        if ($validator->fails()){
            return response()->json($validator->messages()->first(), 422);
        }
        $otp_code = rand(10000,99999);
        $customer=User::where('phone',$request->phone)->firstOrFail();
        $customer->remember_token = $otp_code;
        $customer->remember_token_expired_at = Carbon::now()->addMinute();
        $customer->save();

        //    Now Send the OTP code via SMS Gateway

        return response()->json([
            'data'=>[
                'status'=>'success'
            ]
        ]);
    }

    //    Verify OTP
    public function verifyOTP(Request $request){
        $validator=Validator::make($request->all(), [
            'phone'=>'required|numeric|exists:customers,phone',
            'otp_code'=>'required|string'
        ]);

        if ($validator->fails()){
            return response()->json($validator->messages()->first(), 422);
        }
        $verifyOTP = User::where([['phone',$request->phone],['remember_token',$request->otp_code]])->whareDate('remember_token_expired_at','<=',Carbon::now())->first();
        if (is_null($verifyOTP)){
            return response()->json([
                'data'=>[
                    'status'=>'failed',
                    'message'=>'Invalid OTP Code'
                ]
            ]);
        }
        else{
            $tokenResult=$verifyOTP->createToken('Personal Access Token');
            $token=$tokenResult->accessToken;
            return response()->json([
                'data'=>[
                    'status'=>'success',
                    'access_token'=>$token
                ]
            ]);
        }
    }

    //    Reset Password
    public function resetPassword(Request $request){
        $validator=Validator::make($request->all(), [
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()){
            return response()->json($validator->messages()->first(), 422);
        }
        $user=$request->user();
        $user->password=Hash::make($request->password);
        $user->save();
        return response()->json([
            'data'=>[
                'status'=>'success',
                'message'=>'Your password updated successfully'
            ]
        ]);
    }

    //    For user login
    public function login(Request $request){
        $validator=Validator::make($request->all(), [
            'uname'=>'required|string',
            'password'=>'required|string',
        ]);

        if ($validator->fails()){
            return response()->json($validator->messages()->first(), 422);
        }

        $credentials = ['type'=>'customers', 'status'=>1, 'password'=>$request->password];

        if(is_numeric($request->uname)){
            $credentials['phone']=$request->uname;
        }
        elseif (filter_var($request->uname, FILTER_VALIDATE_EMAIL)) {
            $credentials['email']=$request->uname;
        }


        if (!Auth::attempt($credentials)){
            return response()->json([
                'message'=>'Unauthorized'
            ], 401);
        }

        $user=$request->user();
        $tokenResult=$user->createToken('Personal Access Token');
        $token=$tokenResult->token;

        if ($request->remember_me){
            $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();
        }

        return response()->json([
            'data'=>[
                'status'=>'success',
                'access_token'=>$tokenResult->accessToken,
            ]
        ]);


    }

    //    For user profile
    public function profile(Request $request){
        return new UserResource($request->user());
    }

    //     For logout
    public function logout(Request $request){
        $request->user()->token()->revoke();
        return response()->json([
            'data'=>[
                'status'=>'success'
            ]
        ]);
    }
}
