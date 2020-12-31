<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CouponCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CouponCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupon_codes=CouponCode::where('status',1)->get();
        return view('admin.coupon_code.index',compact('coupon_codes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon_code.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'bail|required|string|max:200',
            'code' => 'bail|required|string|unique:coupon_codes|max:30',
            'valid_from' => 'bail|required|string|max:50',
            'valid_to' => 'bail|required|string|max:50',
            'discount_type' => 'bail|required|integer',
            'discount_amount' => 'bail|required|integer',
            'status' => 'required|integer'
        ]);
        if ($validator->fails()) {
            flash($validator->errors()->first())->error();
            return redirect()->back()->withInput();
        }

        CouponCode::create($request->all());
        flash('New coupon code added successfully')->success();
        return redirect()->action('Admin\CouponCodeController@index');

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
        $coupon_code = CouponCode::findOrFail($id);
        return view('admin.coupon_code.edit',compact('coupon_code'));
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
        $validator = Validator::make($request->all(), [
            'title' => 'bail|required|string|max:200',
            'code' => [
                'required',
                Rule::unique('coupon_codes')->ignore($id),
            ],
            'valid_from' => 'bail|required|string|max:50',
            'valid_to' => 'bail|required|string|max:50',
            'discount_type' => 'bail|required|integer',
            'discount_amount' => 'bail|required|integer',
            'status' => 'required|integer'
        ]);
        if ($validator->fails()) {
            flash($validator->errors()->first())->error();
            return redirect()->back()->withInput();
        }

        $coupon_code = CouponCode::findOrFail($id);
        $coupon_code->code=$request->code;
        $coupon_code->valid_from=$request->valid_from;
        $coupon_code->valid_to=$request->valid_to;
        $coupon_code->max_using_limit=$request->max_using_limit;
        $coupon_code->single_user_max_using_limit=$request->single_user_max_using_limit;
        $coupon_code->min_order_amount=$request->min_order_amount;
        $coupon_code->discount_type=$request->discount_type;
        $coupon_code->discount_amount=$request->discount_amount;
        $coupon_code->max_discount_amount=$request->max_discount_amount;
        $coupon_code->status=$request->status;
        $coupon_code->save();
        flash('Coupon code updated successfully')->success();
        return redirect()->action('Admin\CouponCodeController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CouponCode::destroy($id);
        flash('Coupon code deleted successfully')->error();
        return redirect()->action('Admin\CouponCodeController@index');
    }
}
