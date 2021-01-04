<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KrishiBazarSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class KrishiBazarSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_sliders=KrishiBazarSlider::get();
        return view('admin.cms.slider_image.index', compact('all_sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cms.slider_image.create');
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
            'slider_image' => 'bail|required',
            'slider_url' => 'bail|required|string|max:200',
            'status' => 'required|integer|min:0|max:1',
        ]);
        if ($validator->fails()) {
            flash($validator->errors()->first())->error();
            return redirect()->back()->withInput();
        }
        $allData = $request->all();
        if ($request->hasFile('slider_image')){
            $path=$request->file('slider_image')->store('images');
            $image = Image::make(Storage::get($path))->fit(1087, 500)->encode();
            Storage::put($path, $image);
            $allData['slider_image']=$path;
        }
        KrishiBazarSlider::create($allData);
        flash('New slider added successfully');
        return redirect()->action('Admin\KrishiBazarSliderController@index');
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
        $krishiBazarSlider= KrishiBazarSlider::findOrFail($id);
        return view('admin.cms.slider_image.edit',compact('krishiBazarSlider'));
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
            'slider_url' => 'bail|required|string|max:200',
            'status' => 'required|integer|min:0|max:1',
        ]);
        if ($validator->fails()) {
            flash($validator->errors()->first())->error();
            return redirect()->back()->withInput();
        }
        $krishiBazarSlider= KrishiBazarSlider::findOrFail($id);
        if ($request->hasFile('slider_image')){
            $path=$request->file('slider_image')->store('images');
            $image = Image::make(Storage::get($path))->fit(1087, 500)->encode();
            Storage::put($path, $image);
            Storage::delete($krishiBazarSlider->slider_image);
            $krishiBazarSlider->slider_image=$path;
        }
        $krishiBazarSlider->slider_url = $request->slider_url;
        $krishiBazarSlider->slider_details = $request->slider_details;
        $krishiBazarSlider->status = $request->status;
        $krishiBazarSlider->save();
        flash('Slider updated successfully');
        return redirect()->action('Admin\KrishiBazarSliderController@index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $krishiBazarSlider= KrishiBazarSlider::findOrFail($id);
        Storage::delete($krishiBazarSlider->slider_image);
        $krishiBazarSlider->delete();
        flash('Slider deleted successfully')->success();
        return redirect()->action('Admin\KrishiBazarSliderController@index');

    }
}
