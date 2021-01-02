<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //    For user registration
    public function register(){

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
            'access_token' => $tokenResult->accessToken,
        ]);

    }

    //    For user profile
    public function profile(Request $request){
        return new UserResource($request->user());
    }

    //     For logout
    public function logout(Request $request){
        $request->user()->token()->revoke();
        return response()->json(['status'=>'success']);
    }
}
