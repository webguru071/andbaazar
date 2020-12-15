<?php

namespace App\Http\Controllers;

use App\Mail\VendorProfileRejectMail;
use App\Mail\VendorProfilResubmitMail;
use Illuminate\Http\Request;
use App\Agent;
use App\User;
use App\Events\SellerRegistration;
use App\Models\Shop;
use App\Mail\VendorProfileApprovalMail;
use App\Mail\VendorProfileAcceptMail;
use Session;
use Baazar;
class AgentController extends Controller{


    /***************
     * Agent Login
     ***************/
    public function agentlogin(){
        return view('auth.agent.login');
    }

    /***************
     * Become Agent :GET
     ***************/
    public function becomeAnAgent(){
        return view('agent.become-an-agent');
    }

    /***************
     * Become Agent :POST
     ***************/
    public function becomeAnAgentPost(Request $request, Agent $agent){

        $request->validate([
            'name' => 'required',
            'phone'      => 'required',
        ]);

        $slug = Baazar::getUniqueSlug($agent,$request->name);
        $verify_number = mt_rand(10000,99999);
        $agent = ([
            'name'         => $request->name,
            'slug'               => $slug,
            'phone'              => $request->phone,
            'verification_token' => $verify_number,
            'created_at' => now(),
        ]);

        Agent::create($agent);

        session()->flash('success','Agent profile registration 1st stape complete successfully');

        return redirect('agent-resubmit-token'.'?slug='.$slug);
    }

    /***************
     * Resubmit Token
     ***************/
    public function resubmitToken(Request $request){
        $agent = Agent::where('slug',$request->slug)->first();


        return view('auth.agent.resubmitToken',compact('agent'));
    }

    /***************
     * Token Update :POST
     ***************/
    public function tokenUpdate(Request $request){
        $agent    = Agent::where('slug',$request->slug)->first();

        $verify_number = mt_rand(10000,99999);

        $agent->update([
            'verification_token' => $verify_number,
        ]);

        session()->flash('success','Verify toke re-send successfully!');

        return view('auth.agent.resubmitToken',compact('agent'));

    }

    /***************
     * Token Verify
     ***************/
    public function verifyToken(Request $request){
        $request->validate([
            'verification_token'    => 'required|exists:agents,verification_token|max:5'
        ]);

        $agent    = Agent::where('slug',$request->slug)->first();



       $agent->update([
            'verification_token' => $request->verification_token,
            'slug' => $request->slug,
        ]);

        session()->flash('success','Verification Successfully!');

        return redirect('agent-registration'.'?slug='.$request->slug);


    }

    /***************
     * Agent Registration :GET
     ***************/
    public function agentRegistration(Request $request){
        $agent = Agent::where('slug',$request->slug)->first();

        if(!$agent){
            return redirect('/');
        }

        return view('auth.agent.registration',compact('agent'));
    }

    /***************
     * Agent Registration :POST
     ***************/
    public function agentRegistrationPost(Request $request){

        $request->validate([
            'password'      => 'required|confirmed',
            'email'         => 'required|unique:merchant,email',
            'agreed'        => 'accepted'
        ]);

        $seller = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'password' 	 => $request->password,
            'type'       => 'merchant',
            'create-at'  => now(),
            ]);


        $sellerId    = Merchant::where('slug',$request->slug)->first();

            $sellerId->update([
                'first_name'         => $sellerId->first_name,
                'last_name'          => $sellerId->last_name,
                'phone'              => $sellerId->phone,
                'email'              => $request->email,
                'dob'                => $request->dob,
                'gender'             => $request->gender,
                'description'        => $request->description,
                'last_visited_at'    => now(),
                'last_visited_from'  => $request->last_visited_from,
                'verification_token' => $request->verification_token,
                'status'             => 'Inactive',
                'user_id'            =>  $seller->id,
                'updated_at'         => now(),
            ]);

            // \Mail::to($sellerId)->send(new VendorProfileApprovalMail($sellerId));

        session()->flash('success','Registration Successfully!');

        return redirect('seller-shope-registration'.'?slug='.$request->slug);
    }
}
