<?php

namespace App\Http\Controllers;

use App\Models\KrishiProduct;
use Illuminate\Http\Request;
use App\Models\Merchant; 
use App\Models\ItemImage;
use DB;
use Sentinel;
use Session;
use Baazar; 
use App\Models\Color;
use App\Models\Reject;

class KrishiProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('merchant.product.krishibaazar.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $krishiId = Merchant::where('user_id',Sentinel::getUser()->id)->first();
        return view('merchant.product.krishibaazar.create',compact('krishiId'));
    }

    public function addImages($images, $itemId){
        foreach($images as $color => $image){
            foreach($image as $img){
              $cID = Color::where('slug',$color)->first();
              $i = 0;
              $image = [
  
                'product_id' => $itemId, 
                'color_slug' => $color,
                'color_id'   => $cID ? $cID->id : 0,
                'sort'       => ++$i,
                'type'       => 'Krishi',
                'org_img'    => Baazar::base64Uploadauction($img,'orgimg',$color),
              ];
              // dd($image);
              ItemImage::create($image);
            }
           }
        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,KrishiProduct $krishiProduct)
    {
        // dd($request->all());
        $merchantId =  Merchant::where('user_id',Sentinel::getUser()->id)->first();
        $shop = Merchant::where('user_id',Sentinel::getUser()->id)->first()->shop;
        $slug       = Baazar::getUniqueSlug($krishiProduct,$request->name); 
        $feature    = Baazar::base64Uploadkrishi($request->images['main'][0],$slug,'featured');
        $data = [
            'name'  => $request->name,
            'image' => $feature,
            'email' => $request->email,
            'description' => $request->description,
            'video_url'  => $request->video_url,
            'date'       => $request->date,
            'category_slug' => $request->category_slug,
            'category_id' => $request->category_id,
            'merchant_id' => $merchantId->id,
            'shop_id' => $shop->id,
            'user_id'       => Sentinel::getUser()->id,
            'created_at'    => now(),

        ];
        // $frequency = $data['frequency'];

        $data['frequency'] = implode(',',$request->frequency);

        $krishiProduct = KrishiProduct::create($data);

        if($request->images){
            $this->addImages($request->images,$krishiProduct->id);
          } 

        Session::flash('success', 'Krishi Product Added Successfully!');

          return back();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KrishiProduct  $krishiProduct
     * @return \Illuminate\Http\Response
     */
    public function show(KrishiProduct $krishiProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KrishiProduct  $krishiProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(KrishiProduct $krishiProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KrishiProduct  $krishiProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KrishiProduct $krishiProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KrishiProduct  $krishiProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(KrishiProduct $krishiProduct)
    {
        //
    }
}
