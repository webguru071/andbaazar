<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(){

    }

    public function login(Request $request){
        $validator=Validator::make($request->all(), [
            'email'=>'required|string|email',
            'password'=>'required|string',
        ]);

        if ($validator->fails()){
            return response()->json($validator->messages()->first(), 422);
        }

        $credentials = request(['email', 'password']);


        if (!Auth::attempt($credentials)){
            return response()->json([
                'message'=>'Unauthorized'
            ], 401);
        }

        $employee=$request->user('employee');
        $tokenResult=$employee->createToken('Personal Access Token');
        $token=$tokenResult->token;

        if ($request->remember_me){
            $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();
        }

        return response()->json([
            'access_token' => $tokenResult->accessToken,
        ]);

    }
}
