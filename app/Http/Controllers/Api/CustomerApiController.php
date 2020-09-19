<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use App\User;
use Sentinel;
use Baazar;
class CustomerApiController extends Controller
{
    private $apiToken;
    public function __construct()
    {
        // Unique Token
        $this->apiToken = uniqid(base64_encode(Str::random(60)));
    }

    // public function __construct(){
    //     $this->middleware(['auth:api'])->except('registration','login');
    // }
    public function registration(Request $request){
        try {
            $data = $request->validate([
                'first_name'    => 'required',
                'last_name'     => 'required',
                'email'         => 'required|email|unique:users,email',
                'password'      => 'required|min:6',
            ]);
            // dd($data);

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

            // $accessToken = $customer->createToken('authToken')->accessToken;
            $customer->api_token = $this->apiToken;
            $customer->save();
            return Baazar::apiSuccess(['user' => ['name' => $customer->first_name.' '.$customer->last_name,'email' => $customer->email],'token' => $this->apiToken],'Login Successfully');

            return response()->json(['data' => [
                'user'  => $customer,
                'token' => $this->apiToken
            ],'error' => false,'message' => 'user registeration success']);

        }
        catch (ValidationException $exception) {
            return response()->json([
                'error' => true,
                'msg'    => 'Validation Error',
                'data' => $exception->errors(),
            ], 200);
        }
    }

    public function login(Request $request){
        $credentials = [
			'email'		=> $request->email,
			'password'	=> $request->password,
			'type'	    => 'customers',
		];
		$customer = Sentinel::authenticate($credentials);
        if($customer){
            $customer->api_token = $this->apiToken;
            $customer->save();
            return Baazar::apiSuccess(['user' => ['name' => $customer->first_name.' '.$customer->last_name,'email' => $customer->email],'token' => $this->apiToken],'Login Successfully');
        }else{
            return Baazar::apiError('Invalid Username or Password');
        }
    }

    public function me(Request $request){
        $customer = User::where('api_token',$request->header('Authorization'))->first();
        return Baazar::apiSuccess(['user' => ['name' => $customer->first_name.' '.$customer->last_name,'email' => $customer->email]],'Login Successfully');
    }
}
