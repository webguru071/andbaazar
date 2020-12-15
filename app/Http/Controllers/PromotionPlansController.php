<?php

namespace App\Http\Controllers;

use App\Models\PromotionPlan;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Baazar;
class PromotionPlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $promotion = Promotion::all();
      $promotionplan = PromotionPlan::all();
      return view('admin.promotion_plan.index',compact('promotion','promotionplan'));
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
    public function store(Promotionplan $promotionplan,Request $request)
    {
      $this->validateForm($request);
        $data = [
          'promotion_id' => $request->promotion_id,
            'from_price' => $request->from_price,
            'to_price'   => $request->to_price,
            'amount'     => $request->amount,
            'user_id'    => Auth::user()->id,
            'created_at' => now(),
        ];

        PromotionPlan::create($data);
        Session::flash('success', 'Promotion Plan Inserted Successfully!');
        return redirect('andbaazaradmin/promotionplan');
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
    public function edit(Promotionplan $promotionplan)
    {
      $promotion = Promotion::all();
      return view('admin.promotion_plan.edit',compact('promotion','promotionplan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Promotionplan $promotionplan,Request $request)
    {
      $this->validateForm($request);
      $data = [
          'promotion_id' => $request->promotion_id,
          'from_price'   => $request->from_price,
          'to_price'     => $request->to_price,
          'amount'       => $request->amount,
          'user_id'      => Auth::user()->id,
          'created_at'   => now(),
      ];
      $promotionplan->update($data);
    Session::flash('warning', 'Promotion Plan Updated Successfully!');
     return redirect('andbaazaradmin/promotionplan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotionplan $promotionplan)
    {
      $promotionplan->delete();
      Session::flash('error', 'Promotion Plan Deleted Successfully!');
      return redirect('andbaazaradmin/promotionplan');
    }

    private function validateForm($request){
        $validatedData = $request->validate([
            'from_price'   => 'required|max:4',
            'to_price'     => 'required|max:4',
            'amount'       => 'required|max:4',
            'promotion_id' => 'required',
        ]);
    }
}
