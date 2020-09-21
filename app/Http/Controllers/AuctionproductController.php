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
use App\Models\Reject;
use App\Mail\auctionApprovemail;
use App\Mail\auctionRejectmail;

 





class AuctionproductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      // $sellerProfile = Merchant::with('rejectvalue')->where('user_id',Sentinel::getUser()->id)->first();
        $product = Auctionproduct::all();
        $rejectReason = RejectValue::where('user_id',Sentinel::getUser()->id)->where('type','sme')->get();

      // $items = Product::with('inventory')->paginate('10');
      

  //    if ($request->has('cat')){

  //       $product = Product::where('shop_id',Baazar::shop()->id)->where('category_slug','like','%'.$request->cat.'%')->where('type','sme')->paginate(10);            
  //   } 
    
  //   if ($request->has('status')){   
  //     $product =Product::orderBy('status','asc')->Where('status',$request->status)->where('type','sme')->paginate(10);
  //   // dd($product);        
  // } 
  //   $categories = ([
  //     'cat'      =>request('cat'),
  //     'status'   => request('status'),
  // ]);

  return view('auction.product.index',compact('product'));

   
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id',0)->get();
        $auctionerId = Merchant::where('user_id',Sentinel::getUser()->id)->first();
        return view('auction.product.create',compact('categories','auctionerId'));
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
              'type'       => 'Auction',
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
            'email'         => $request->email,
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

        if($request->images){
            $this->addImages($request->images,$auctionproduct->id);
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
    public function show($id)
    {
      $auctionproduct = Auctionproduct::find($id);
      // dd($auctionproduct);
      $auctionproductImage = ItemImage::where('color_slug','main')->where('product_id',$auctionproduct->id)->where('type','Auction')->limit(5)->get();
      // dd($auctionproductImage);
       $rejectlist = Reject::where('type','auction')->get();
        return view('auction.product.show',compact('auctionproduct','auctionproductImage','rejectlist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Auctionproduct  $auctionproduct
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
      $categories = Category::where('parent_id',0)->get(); 
      $auctionproduct = Auctionproduct::where('slug',$slug)->first();
      // dd($auctionproduct);
      $itemImages =  $auctionproduct->itemimage->groupBy('color_slug');
       return view('auction.product.edit',compact('categories','auctionproduct','itemImages'));
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
      // dd($request->all());
        $auctionproductId = Auctionproduct::where('slug',$slug)->first();
        // dd($auctionproductId);
        $auctionproductId->itemimage()->delete();
        $feature          = Baazar::base64Uploadauction($request->images['main'][0],$slug,'featured');

        $data = [
            'name'          => $request->name,
            'image'         => $feature, 
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

    public function auctionProductList(){
      $auctionproduct = Auctionproduct::distinct()->get();

      // dd($auctionproduct);

      return view('auction.product.auctionproduct_list',compact('auctionproduct'));
    }

    public function approvemetnt($slug){
      $data = Auctionproduct::where('slug',$slug)->first();

      $data->update(['status' => 'Active']);
      // dd($data);

      $name =  $data['name'];
      \Mail::to($data['email'])->send(new auctionApprovemail($data, $name));

      Session::flash('success', 'Auction Product Approve Successfully!');

      return back();
    }

    public function rejected(Request $request,$slug){
      $data = Auctionproduct::where('slug',$slug)->first();

      $data->update([
        'status' => 'Reject',
        'rej_desc' => $request->rej_desc,
        ]);

        $rejct_value = RejectValue::where('id', $data->id)->first();

        $rej_list = count($_POST['rej_name']);
        
        for($i = 0; $i<$rej_list; $i++){        
                $rejct_value=RejectValue::create([
                'rej_name'      => $request->rej_name[$i],
                'type'          => $request->type,
                'merchant_id'   => $data->id,
                'user_id'       => $data->user_id,
            ]);
            // dd($data);
        } 
        
        $name = $data['name'];
        $rej_desc = $data['rej_desc'];
        \Mail::to($data['email'])->send(new auctionRejectmail($data, $name,$rej_desc));
        
        Session::flash('warning', 'Auction Product Rejected Successfully!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Auctionproduct  $auctionproduct
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $auctionproduct = Auctionproduct::find($id); 
        $auctionproduct->delete();

        Session::flash('error', 'Auction Product Deleted Successfully!');

        return redirect('merchant/auction/products');

    }
}
