<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Baazar;
use Session;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $userprofile = Auth::user();
        $profile = Customer::where('user_id',Auth::user()->id)->first();
        if(!empty($profile))
            return view('frontend.customers.update',compact('profile','userprofile'));
        else
        return view('frontend.customers.create',compact('profile','userprofile'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $userprofile = Auth::user();
        $buyerId = Customer::where('user_id',Auth::user()->id)->first();
        if($buyerId){
           $buyerId->update([
                'first_name'            => $request->first_name,
                'last_name'             => $request->last_name,
                'phone'                 => $request->phone,
                'picture'               => Baazar::fileUpload($request,'picture','old_image','/uploads/buyer_profile'),
                'dob'                   => $request->dob,
                'gender'                => $request->gender,
                'description'           => $request->description,
                'updated_at'            => now(),
            ]);

            $userprofile->update([
                'first_name'            => $request->first_name,
                'last_name'             => $request->last_name,
            ]);


            Session::flash('success','Profile update Successfully');
            return back();
        }else{
            $data =[
                'first_name'            => $request->first_name,
                'last_name'             => $request->last_name,
                'phone'                 => $request->phone,
                'picture'               => Baazar::fileUpload($request,'picture','','/uploads/buyer_profile'),
                'dob'                   => $request->dob,
                'gender'                => $request->gender,
                'description'           => $request->description,
                'user_id'               => Auth::user()->id,
                'created_at'            => now(),
            ];

            Customer::create($data);

            $userprofile->update([
                'first_name'            => $request->first_name,
                'last_name'             => $request->last_name,
            ]);
            Session::flash('success','Profile Create Successfully');
            return back();
        }

        Session::flash('danger','please insert your profile inforation correctley');
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function validateForm($request){
        $validatedData = $request->validate([
               'first_name'  => 'required',
               'last_name'   => 'required',
               'dob'         => 'required',
               'gender'      => 'required',
               'description' => 'required',
        ]);
    }
}
