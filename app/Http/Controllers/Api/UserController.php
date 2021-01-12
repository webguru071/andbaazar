<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Traits\apiTrait;
use App\Mail\VerifyEmail;
use App\Models\AgentProfile;
use App\Models\CustomerProfile;
use App\Models\MerchantProfile;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use apiTrait;
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
            return $this->jsonResponse([],$validator->messages()->first());
        }
        $allData=$request->all();
        $allData['password']=Hash::make($request->password);
        $allData['type']=$request->user_type;
        $user=User::create($allData);
        $allData['user_id']=$user->id;
        switch ($request->user_type) {
            case "customer":
                $user->status = 1;
                $user->save();
                CustomerProfile::create($allData);
                break;
            case "merchant":
                MerchantProfile::create($allData);
                break;
            case "agent":
                AgentProfile::create($allData);
                break;
        }

        return $this->jsonResponse([],"Yor have been register successfully",false);
    }

    //    Forget Password
    public function forgetPassword(Request $request){
        $validator=Validator::make($request->all(), [
            'phone'=>'required|numeric|exists:users,phone',
        ]);

        if ($validator->fails()){
            return $this->jsonResponse([],$validator->messages()->first());
        }
        $otp_code = rand(10000,99999);
        $customer=User::where('phone',$request->phone)->firstOrFail();
        $customer->phone_otp = $otp_code;
        $customer->phone_otp_expired_at = Carbon::now()->addMinute();
        $customer->save();

        //    Now Send the OTP code via SMS Gateway
        return $this->jsonResponse([],"OTP send to your mobile number",false);
    }

    //    Send Verify OTP
    public function sendVerifyOTP(Request $request){
        $validator=Validator::make($request->all(), [
            'phone'=>'required|numeric|exists:users,phone',
        ]);

        if ($validator->fails()){
            return $this->jsonResponse([],$validator->messages()->first());
        }
        $otp_code = rand(10000,99999);
        $customer=User::where('phone',$request->phone)->firstOrFail();
        $customer->phone_otp = $otp_code;
        $customer->phone_otp_expired_at = Carbon::now()->addMinute();
        $customer->save();

        //    Now Send the OTP code via SMS Gateway
        return $this->jsonResponse([],"OTP send to your mobile number",false);
    }

    //    Send Email Verification Link
    public function sendEmailVerificationLink(Request $request){
        $validator=Validator::make($request->all(), [
            'email'=>'required|email|exists:users,email',
        ]);

        if ($validator->fails()){
            return $this->jsonResponse([],$validator->messages()->first());
        }

        $customer=User::where('email',$request->email)->firstOrFail();
        $email_verification_code = Str::random(60);
        $customer->email_verification_code = $email_verification_code;
        $customer->email_verification_code_expired_at = Carbon::now()->addDays(2);
        $customer->save();
        $emailData['user_name']=$customer->first_name .' ' .$customer->last_name;
        $emailData['verificationURL']=env('APP_URL') .'/email/verify/' .$customer->id .'/' .$email_verification_code;
        Mail::to($request->email)->send(new VerifyEmail($emailData));
        return $this->jsonResponse([],"Verification link send to your email address",false);
    }

    //    Verify OTP
    public function verifyOTP(Request $request){
        $validator=Validator::make($request->all(), [
            'phone'=>'required|numeric|exists:users,phone',
            'otp_code'=>'required|string'
        ]);

        if ($validator->fails()){
            return $this->jsonResponse([],$validator->messages()->first());
        }
        $verifyOTP = User::where([['phone',$request->phone],['phone_otp',$request->otp_code]])->where('phone_otp_expired_at','>',Carbon::now())->first();
        if (is_null($verifyOTP)){
            return $this->jsonResponse([],'opt verified failed');
        }
        else{
            $verifyOTP->phone_no_verified_at = Carbon::now();
            $verifyOTP->save();
            $tokenResult=$verifyOTP->createToken('Personal Access Token');
            $token=$tokenResult->accessToken;
            $data = [
                'status'=>'success',
                'access_token'=>$token
            ];
            return $this->jsonResponse($data,"Login successfully",false);
        }
    }

    //    Reset Password
    public function resetPassword(Request $request){
        $validator=Validator::make($request->all(), [
            'password' => 'required|confirmed|min:8',
        ]);

        if ($validator->fails()){
            return $this->jsonResponse([],$validator->messages()->first());
        }
        $user=$request->user();
        $user->password=Hash::make($request->password);
        $user->save();
        return $this->jsonResponse([],"Your password updated successfully",false);
    }

    //    For user login
    public function login(Request $request){
        $validator=Validator::make($request->all(), [
            'uname'=>'required|string',
            'password'=>'required|string',
        ]);

        if ($validator->fails()){
            return $this->jsonResponse([],$validator->messages()->first());
        }

        $validationType = '';
        $credentials = ['status'=>1, 'password'=>$request->password];

        if(is_numeric($request->uname)){
            $credentials['phone']=$request->uname;
            $validationType = 'phone';
        }
        elseif (filter_var($request->uname, FILTER_VALIDATE_EMAIL)) {
            $credentials['email']=$request->uname;
            $validationType = 'email';
        }

        if (!Auth::attempt($credentials)){
            return $this->jsonResponse([],'Invalid login',true);
        }
        else{
            $user=$request->user();
            if (($validationType == 'phone') && (is_null($user->phone_no_verified_at))){
                return response()->json([
                    'error'=>true,
                    'msg'=>'Please verify your phone number',
                    'data'=>[],
                    "flag"=> "mobile"
                ]);
            }
            elseif (($validationType == 'email') && (is_null($user->email_verified_at))){
                return response()->json([
                    'error'=>true,
                    'msg'=>'Please verify your email address',
                    'data'=>[],
                    "flag"=> "email"
                ]);
            }
        }

        $tokenResult=$user->createToken('Personal Access Token');
        $token=$tokenResult->token;

        if ($request->remember_me){
            $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();
        }

        $data=[
            'access_token'=>$tokenResult->accessToken,
        ];

        return $this->jsonResponse($data,"You logged in successfully",false);
    }

    //    For user profile
    public function profile(Request $request){
        return new UserResource($request->user());
    }

    //     For logout
    public function logout(Request $request){
        $request->user()->token()->revoke();
        return $this->jsonResponse([],'You logout successfully',false);
    }
}
