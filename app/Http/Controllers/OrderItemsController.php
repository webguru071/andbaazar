<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderItemsController extends Controller
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
        $data = [
            'qty' =>$request->qty,
            'rate' =>$request->rate,
            'amount' =>$request->amount,
            'order_id' =>$request->order_id,
            'shop_id' =>$request->shop_id,
            'item_id' =>$request->item_id,
            'color_id' =>$request->color_id,
            'size_id' =>$request->size_id,
            'user_id' => Auth::user()->id,
            'created_at' => now(),
        ];

        OrderItem::create($data);
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
            'qty' => 'required',
            'rate' => 'required',
            'shop_id' => 'required',
            'item_id' => 'required',
            'color_id' => 'required',
            'size_id' => 'required',
        ]);
    }
}
