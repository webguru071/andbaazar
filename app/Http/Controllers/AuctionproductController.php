<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Mail\ProductApproveRequestMail;
use App\Mail\productApproveMail;
use App\Mail\ProductRejectMail;
use App\Models\RejectValue;
use App\Models\Category;
use App\Models\Auctionproduct;
use App\Models\ItemImage;
use App\Models\Merchant; 
use Sentinel;
use Session;
use Baazar; 
use App\Models\Color;

 





class AuctionproductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         // $cats = \DB::table('products')->select('category_id')->distinct()->get();
      // dd($cats);
      $product = Auctionproduct::with('user')->where('merchant_id',Baazar::shop()->id);
     

      $cat = $product->select('category_id')->distinct()->get();
      // dd($cat);
      // $sellerProfile = Merchant::with('rejectvalue')->where('user_id',Sentinel::getUser()->id)->first();
      $item = Auctionproduct::where('user_id',Sentinel::getUser()->id)->get();
      // dd($item);
      $product = Auctionproduct::with('rejectvalue')->where('merchant_id',Baazar::shop()->id)->where('type','ecommerce');
      // dd($product);
      $rejectReason = RejectValue::where('user_id',Sentinel::getUser()->id)->where('type','ecommerce')->get();
      // dd($rejectReason);
      // $items = Product::with('inventory')->paginate('10');
      $filter = [
        'category'  => '',
        'status'  => '',
        'keyword'  => '',
      ];
      $findCat = Auctionproduct::where('merchant_id',Baazar::shop()->id)->where('type','ecommerce');
          $categories = $findCat->select('category_id')->with('category')->distinct()->get();

      if ($request->has('cat')){
        $product = Auctionproduct::where('merchant_id',Baazar::shop()->id)->where('category_slug','like','%'.$request->cat.'%')->where('type','ecommerce');
        }
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
      return view ('auction.product.index',compact('product','categories','filter'));       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id',0)->get();
        return view('auction.product.create',compact('categories'));
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
              'type' => 'Auction',
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
    public function store(Request $request,Auctionproduct $auctionproduct)
    {
        // dd($request->all());
        $merchantId =  Merchant::where('user_id',Sentinel::getUser()->id)->first();
        $slug       = Baazar::getUniqueSlug($auctionproduct,$request->name);      

        $feature    = Baazar::base64Uploadauction($request->images['main'][0],$slug,'featured');
        // dd($feature);

        $data = [
            'name'          => $request->name,
            'image'         => $feature,
            'slug'          => $slug,
            'description'   => $request->description,
            'qty'           => $request->qty,
            'unit'          => $request->unit,
            'category_slug' => $request->category,
            'category_id'   => $request->category_id,
            'merchant_id'   => $merchantId->id,
            'user_id'       => Sentinel::getUser()->id,
            'created_at'    => now(),
        ];
        

        $auctionproduct = Auctionproduct::create($data);

        if($request->image){
            $this->addImages($request->image,$auctionproduct->id);
          } 

          Session::flash('success', 'Auction Product Added Successfully!');

          return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Auctionproduct  $auctionproduct
     * @return \Illuminate\Http\Response
     */
    public function show(Auctionproduct $auctionproduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Auctionproduct  $auctionproduct
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $categories = Auctionproduct::all(); 
       return view('auction.product.edit',compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Auctionproduct  $auctionproduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Auctionproduct $auctionproduct,$slug)
    {
        $auctionproductId = Auctionproduct::find('slug',$slug)->first();
        $auctionproductId->itemimage()->where('type','Auction')->delete();
        $feature          = Baazar::base64Uploadauction($request->images['main'][0],$slug,'featured');

        $data = [
            'name'          => $request->name,
            'images'        => $feature, 
            'description'   => $request->description,
            'qty'           => $request->qty,
            'unit'          => $request->unit,
            'category_slug' => $request->category,
            'category_id'   => $request->category_id, 
            'updated_at'    => now(),
        ];

        $auctionproductId->update($data);

        if($request->images){
            $this->addImages($request->images,$auctionproductId->id);
          } 

          Session::flash('success', 'Auction Product updated Successfully!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Auctionproduct  $auctionproduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(Auctionproduct $auctionproduct)
    {
        //
    }
}
