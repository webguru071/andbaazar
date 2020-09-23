<?php

namespace App\Http\Controllers;

use App\Models\KrishiProduct;
use Illuminate\Http\Request;
use App\Models\Merchant; 
use App\Models\ItemImage;
use App\Models\Category;
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
    public function index(Request $request)
    {

        $product      = KrishiProduct::where('shop_id',Baazar::shop()->id)->where('type','krishi');
        

      $filter = [
        'category'  => '',
        'status'  => '',
        'keyword'  => '',
      ];

      $findCat = KrishiProduct::where('shop_id',Baazar::shop()->id)->where('type','krishi');
      $categories = $findCat->select('category_id')->with('category')->distinct()->get();

      //Category Filter
      if ($request->has('category') && !empty($request->category)){
        $catId = Category::where('slug',$request->category)->first();
        if($catId){
          $product = $product->where('category_id',$catId->id);
        }
        $filter['category'] = $request->category;

      }
      
      //status Filter
      if ($request->has('status') && !empty($request->status)){
        $product = $product->where('status',$request->status);
        $filter['status'] = $request->status;
      }

      //status Filter
      if ($request->has('keyword') && !empty($request->keyword)){
        $product = $product->where('name','like','%'.$request->keyword.'%');
        $filter['keyword'] = $request->keyword;
      }

      // dd($product);
      $product = $product->paginate(10);
      $product = $product->withPath("products?keyword={$filter['keyword']}&category={$filter['category']}&status={$filter['status']}");
      return view ('merchant.product.krishibaazar.index',compact('product','categories','filter'));
       
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $krishiId = Merchant::where('user_id',Sentinel::getUser()->id)->first();
        $categories = Category::where('parent_id',0)->where('type','krishi')->get();
        return view('merchant.product.krishibaazar.create',compact('krishiId','categories'));
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
        $shop       = Merchant::where('user_id',Sentinel::getUser()->id)->first()->shop;
        $slug       = Baazar::getUniqueSlug($krishiProduct,$request->name); 
        $feature    = Baazar::base64Uploadkrishi($request->images['main'][0],$slug,'featured');
        $data = [
            'name'          => $request->name,
            'slug'          => $slug,
            'image'         => $feature,
            'email'         => $request->email,
            'description'   => $request->description,
            'video_url'     => $request->video_url,
            'date'          => $request->date,
            'category_slug' => $request->category,
            'category_id'   => $request->category_id,
            'merchant_id'   => $merchantId->id,
            'shop_id'       => $shop->id,
            'user_id'       => Sentinel::getUser()->id,
            'created_at'    => now(),

        ];
        // $frequency = $data['frequency']; 

        $data['frequency'] = json_encode($request->frequency);

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
    public function edit($slug)
    {
        $krishiproduct = KrishiProduct::where('slug',$slug)->first();
        $frequencyname = json_decode($krishiproduct->frequency);
        // dd($frequencyname);
        $itemImages    = $krishiproduct->itemimage->groupBy('color_slug');
        $categories = Category::where('parent_id',0)->where('type','krishi')->get();
        
        return view('merchant.product.krishibaazar.edit',compact('krishiproduct','frequencyname','itemImages','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KrishiProduct  $krishiProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KrishiProduct $krishiProduct,$slug)
    {
        // dd($request->all());
        $krishiproductId = KrishiProduct::where('slug',$slug)->first();
        $krishiproductId->itemimage()->delete();
        $feature    = Baazar::base64Uploadkrishi($request->images['main'][0],$slug,'featured');
        $data = [
            'name'          => $request->name, 
            'image'         => $feature,
            'email'         => $request->email,
            'description'   => $request->description,
            'video_url'     => $request->video_url,
            'date'          => $request->date,
            'category_slug' => $request->category,
            'category_id'   => $request->category_id, 
            'updated_at'    => now(),

        ];
        // $frequency = $data['frequency'];
       

        $data['frequency'] = json_encode($request->frequency);

        $krishiproductId->update($data);

        if($request->images){
            $this->addImages($request->images,$krishiproductId->id);
          } 

        Session::flash('success', 'Krishi Product Update Successfully!');

          return back();
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
