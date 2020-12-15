<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Session;
use Reminder;
use Mail;
use App\Events\CustomerRegistration;

class CustomerController extends Controller{
    public function __construct(){
        $this->middleware(['auth','customer'])->except('register','userlogin','registration','userloginprocess');
    }

    public function dashboard(){
        return view('buyer-dashboard');
    }

    public function register(){
        return view('auth.customer.register');
    }

    public function registration(Request $request){
        $data = [
		    'first_name'=> $request->first_name,
		    'last_name' => $request->last_name,
		    'email' 	=> $request->email,
		    'password' 	=> $request->password,
		    'type' 	    => 'customers',
		];
        $customer = User::create($data);
        // dd($customer);
        event(new CustomerRegistration($customer));
        // echo 'done';
        return redirect('dashboard');
    }

    public function userloginprocess(Request $request){
        $credentials = [
			'email'		=> $request->login['email'],
			'password'	=> $request->login['password'],
			'type'	    => 'customers',
		];

        $user = Auth::attempt($credentials);
		if($user)
			return redirect('dashboard');
		else
			return redirect('login')->with('error', 'Invalid email or password');
    }

    public function userlogin(){
        return view('auth.customer.login');
    }

// Forgot password......
    public function forgot(){
        return view('auth.customer.forgotpassword');
    }

    public function password(Request $request){

        //   dd($request->all());

          $user = User::whereEmail($request->email)->first();

          if($user == null){

            return redirect()->back()->with(['error'=> 'Email not exists']);
          }

          $user = User::find($user->id);

          $reminder = Reminder::exists($user) ? : Reminder::create($user);

          $this->sendEmail( $user);

          return redirect()->back()->with(['success'=> 'Reset code sent to your emai']);
            // return view('auth.merchant.setnewpassword');
           }

           public function sendEmail($user){
               Mail::send(
                   'admin.emails.customerforgot',
                   ['user' => $user],
                   function($message) use ($user) {
                       $message->to($user->email);
                       $message->subject("$user->name,Reset Your password");
                   }
                );
           }
    // Reset Password.....

    public function reset(Request $request){

        $email = User::whereEmail($request->email)->first();
        // $user = User::all();
        return view('auth.customer.resetpassword',compact('email'));
    }

     public function updatePassword(Request $request,$email){
         //dd($request->all());
        $request->validate([
            'password' => 'required|'
        ]);

        $user  = User::where('email',$email)->first();
        //dd($seller);

       $user->update([
            'password' => bcrypt($request->password),
        ]);

        Session::flash('success', 'Password  Reset Successfully!');
        return redirect('login');
    }

}
