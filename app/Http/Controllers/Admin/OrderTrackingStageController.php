<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderTrackingStage;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;

class OrderTrackingStageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $order_satges=OrderTrackingStage::all();

        $orderTrackingStages = OrderTrackingStage::orderBy('order')->get();
//        return view('admin.payment_methods.index',compact('paymentmethod'));

        return view('admin.order_tracking_stage.index',compact('orderTrackingStages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.order_tracking_stage.create');
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
            'stage_name' => 'required|string|max:200',
        ]);
        if ($validator->fails()) {
            flash($validator->errors()->first())->error();
            return redirect()->back()->withInput();
        }
        $allData=$request->all();
        $allData['order']=OrderTrackingStage::all()->count() +1;
        OrderTrackingStage::create($allData);
        flash('New order tracking stage added successfully');
        return redirect()->action('Admin\OrderTrackingStageController@index');
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
        $order_stage=OrderTrackingStage::findOrFail($id);
        return view('admin.order_tracking_stage.edit',compact('order_stage'));
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
            'stage_name' => 'required|string|max:200',
        ]);
        if ($validator->fails()) {
            flash($validator->errors()->first())->error();
            return redirect()->back()->withInput();
        }
        $order_stage=OrderTrackingStage::findOrFail($id);
        $order_stage->stage_name=$request->stage_name;
        $order_stage->details=$request->details;
        $order_stage->save();
        Session::flash('warning', 'Order Tracking Stage Updated Successfully!');
        return redirect()->action('Admin\OrderTrackingStageController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        OrderTrackingStage::destroy($id);
        Session::flash('error', 'Order Tracking Stage Deleted Successfully');
        return redirect()->action('Admin\OrderTrackingStageController@index');
    }

    public function updateTrackingStageOrder(Request $request){
        foreach ($request->trackingStageOrders as $index=>$stageOrder){
            $tracking_stage=OrderTrackingStage::findOrFail($stageOrder);
            $tracking_stage->order=$index+1;
            $tracking_stage->save();
        }
        return response('success');
    }
}
