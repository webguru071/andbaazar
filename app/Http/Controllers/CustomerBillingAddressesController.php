<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerBillingAddress;
use App\Models\CustomerProfile;
use Illuminate\Support\Facades\Auth;
use Session;
use Baazar;

class CustomerBillingAddressesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $billing = CustomerBillingAddress::where('user_id',Auth::user()->id)->get();
        return view('frontend.customer_billing_address.index',compact('billing'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.customer_billing_address.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,CustomerBillingAddress $billing)
    {
        $customerId = CustomerProfile::where('user_id',Auth::user()->id)->first();
        //dd($buyerId);
        $slug = Baazar::getUniqueSlug($billing,$request->location);
        $this->validateForm($request);
        if($customerId){
            $data = [
                'location'      => $request->location,
                'slug'          => $slug,
                'address'       => $request->address,
                'country'       => $request->country,
                'state'         => $request->state,
                'city'          => $request->city,
                'zip_code'      => $request->zip_code,
                'phone'         => $request->phone,
                'fax'           => $request->fax,
                'customer_id'   =>  $customerId->id,
                'user_id'       => Auth::user()->id,
                'created_at'    => now(),
            ];

            CustomerBillingAddress::create($data);

            Session::flash('success', 'Billing Address created');

            return redirect('customer/billing');
         }

        Session::flash('error', 'please create profile correctly');

        return redirect('customer/billing');



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
    public function edit($slug)
    {
        $billing = CustomerBillingAddress::where('slug',$slug)->first();
        return view('frontend.customer_billing_address.edit',compact('billing'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $billing = CustomerBillingAddress::where('slug',$slug)->first();
        $this->validateForm($request);

            $data = [
                'location'      => $request->location,
                'address'       => $request->address,
                'country'       => $request->country,
                'state'         => $request->state,
                'city'          => $request->city,
                'zip_code'      => $request->zip_code,
                'phone'         => $request->phone,
                'fax'           => $request->fax,
                'user_id'       => Auth::user()->id,
                'updated_at'    => now(),
            ];

            $billing->update($data);

            Session::flash('warning', 'Billing Address Updated');

            return redirect('customer/billing');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerBillingAddress $billing)
    {
        $billing->delete();

        Session::flash('error', 'Billing Address Deleted');

        return redirect('customer/billing');
    }

    private function validateForm($request){
        $validatedData = $request->validate([
            'location'      => 'required',
            'address'       => 'required',
            'country'       => 'required',
            'state'         => 'required',
            'city'          => 'required',
            'zip_code'      => 'required',
            'phone'         => 'required',
        ]);
    }
}
