<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\ItemImage;
use App\Models\Product;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Merchant;
use Sentinel;
use Baazar;
use Session;

class ShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shop = Shop::all();
        $seller = Merchant::all();   
        return view('admin.shop_list.index',compact('shop','seller'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {  
        $product = Product::all();
        
        // dd($product);
        $items = Product::with('inventory')->paginate(2);

        $category = Category::where('parent_id',0)->get();

        $sellerProfile = Merchant::where('user_id',Sentinel::getUser()->id)->first();
        $shopProfile = Shop::where('user_id',Sentinel::getUser()->id)->first();


        // dd($request->all());

        $categories = new category;

         if (request()->has('cat')){
             $categories =$categories->where('cat',request('cat'));  
             
             dd($categories);
         }

         if (request()->has('sort')){
            $categories =$categories->orderBy('name',request('sort'));             
        }

    $categories = $categories->paginate(5)->appends([
        'cat'      =>request('cat'),
        'sort'     => request('sort'),
    ]);
       
        return view('merchant.shops.update',compact('sellerProfile','shopProfile','product','items','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //
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

    // public function sort()
    // {

    //     $product = Product::all();
    //     $items = Product::with('inventory')->paginate(4);

    //     $category = Category::where('parent_id',0)->get();

    //     $sellerProfile = Merchant::where('user_id',Sentinel::getUser()->id)->first();
    //     $shopProfile = Shop::where('user_id',Sentinel::getUser()->id)->first();

    //     $categories = new category;

    //      if (request()->has('category')){
    //          $categories =$categories->where('color_slug',request('color_slug'));  
             
    //          dd( $categories);
    //      }

    //      if (request()->has('sort')){
    //         $categories =$categories->orderBy('name',request('sort'));             
    //     }

    // $categories = $categories->paginate(5)->appends([
    //     'color_slug' =>request('color_slug'),
    //     'sort'     => request('sort'),
    // ]);

    // return view('merchant.shops.update',compact('sellerProfile','shopProfile','product','items','categories','category'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shopProfile = Shop::where('user_id',Sentinel::getUser()->id)->first();
        $shop = Shop::all();
        return view('merchant.shops.edit',compact('shopProfile','shop'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $shop = Shop::where('user_id',Sentinel::getUser()->id)->first();
        //dd($shop);
        $this->validateForm($request);

            $shop->update([
                'name'              => $request->name,
                'slogan'            => $request->slogan,
                'phone'             => $request->phone,
                // 'logo'              => Baazar::fileUpload($request,'logo','old_image','/uploads/shops/logos'),
                // 'google_location'   => $request->google_location,
                // 'banner'            => Baazar::fileUpload($request,'logo','old_image','/uploads/shop_banner'),
                'email'             => $request->email,
                'web'               => $request->web,
                'lat'               => $request->lat,
                'lng'               => $request->lng,
                'facebook'          => $request->facebook,
                'instagram'         => $request->instagram,
                'twitter'           => $request->twitter,
                'youtube'           => $request->youtube,
                'description'       => $request->description,
                'bdesc'             => $request->bdesc,
                'updated_at'        => now(),
            ]);


        session()->flash('success','your shop profile updated');
        return redirect('merchant/shop');
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
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'slogan' => 'required',
        ]);
    }
}
