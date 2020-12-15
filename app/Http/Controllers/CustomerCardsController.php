<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\CustomerCard;
use Illuminate\Support\Facades\Auth;
use Session;
use Baazar;

class CustomerCardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $card = CustomerCard::where('user_id',Auth::user()->id)->get();
        return view('frontend.customer_cards.index',compact('card'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.customer_cards.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,CustomerCard $card)
    {
        $customerId = Customer::where('user_id',Auth::user()->id)->first();
        $slug = Baazar::getUniqueSlug($card,$request->card_holder_name);
        $this->validateForm($request);
        if($customerId){
            $data = [
            'card_number'       => $request->card_number,
            'slug'              => $slug,
            'card_holder_name'  => $request->card_holder_name,
            'card_expire_date'  => $request->card_expire_date,
            'card_cvc'          => $request->card_cvc,
            'customer_id'       => $customerId->id,
            'user_id'           => Auth::user()->id,
            'created_at'        => now(),
            ];

            CustomerCard::create($data);

            Session::flash('success', 'Billing Card created');

            return redirect('customer/card');
        }
        Session::flash('danger', 'Somthing want wrong please fill up the form correctly');
        return redirect('customer/card');
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
        $card = CustomerCard::where('slug',$slug)->first();
        return view('frontend.customer_cards.edit',compact('card'));
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
        $card = CustomerCard::where('slug',$slug)->first();
        $this->validateForm($request);
            $data = [
            'card_number' => $request->card_number,
            'card_holder_name' => $request->card_holder_name,
            'card_expire_date' => $request->card_expire_date,
            'card_cvc' => $request->card_cvc,
            'user_id' => Auth::user()->id,
            'updated_at' => now(),
            ];

            $card->update($data);

            Session::flash('warning', 'Billing Card updated');

            return redirect('customer/card');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerCard $card)
    {
        $card->delete();

        Session::flash('error', 'Billing Card Deleted');

        return redirect('customer/card');
    }

    private function validateForm($request){
        $validatedData = $request->validate([
            'card_number' => 'required',
            'card_holder_name' => 'required',
            'card_expire_date' => 'required',
            'card_cvc' => 'required'
        ]);
    }
}
