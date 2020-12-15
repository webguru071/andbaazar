<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateForm($request);
        $data = [
            'order_number' =>$request->order_number,
            'invoice_number' =>$request->invoice_number,
            'tracking_number' =>$request->tracking_number,
            'subtotal' =>$request->subtotal,
            'discount' =>$request->discount,
            'shipping_cost' =>$request->shipping_cost,
            'grand_total' =>$request->grand_total,
            'admin_note' =>$request->admin_note,
            'shipping_track' =>$request->shipping_track,
            'confirm_at' =>$request->confirm_at,
            'back_ordered_at' =>$request->back_ordered_at,
            'cancel_at' =>$request->cancel_at,
            'status' =>$request->status,
            'buyer_id' =>$request->buyer_id,
            'buyer_billing_address_id' =>$request->buyer_billing_address_id,
            'buyer_shipping_address_id' =>$request->buyer_shipping_address_id,
            'buyer_card_id' =>$request->buyer_card_id,
            'shipping_method_id' =>$request->shipping_method_id,
            'user_id' => Auth::user()->id,
            'created_at' => now(),
        ];

        Order::create($data);
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
            'order_number' => 'required',
            'invoice_number' => 'required',
            'tracking_number' => 'required',
            'subtotal' => 'required',
            'discount' => 'required',
            'shipping_cost' => 'required',
            'grand_total' => 'required',
            'shipping_track' => 'required',
            'confirm_at' => 'required'
        ]);
    }
}
