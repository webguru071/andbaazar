<?php

namespace App\Http\Controllers;

use App\Models\KrishiCategory;
use App\Models\KrishiProduct;
use App\Models\KrishiProductItemImage;
use App\Models\ProductUnit;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\MerchantProfile;
use App\Models\ItemImage;
use App\Models\Category;
use DB;
use App\Models\Newsfeed;
use App\Models\KrishiReviews;
use Illuminate\Support\Facades\Auth;
use Session;
use Baazar;
use App\Models\Color;
use App\Models\Reject;
use App\Models\RejectValue;
use App\Mail\KrishiProductApprovemail;
use App\Mail\KrishiProductRejectMail;
use Illuminate\Support\Facades\Storage;

class KrishiProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $product  = KrishiProduct::where('shop_id',Baazar::shop()->id);
        $filter = [
            'category'  => '',
            'status'    => '',
            'keyword'   => '',
        ];

        $findCat = KrishiProduct::where('shop_id',Baazar::shop()->id);
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
        $krishiId = MerchantProfile::where('user_id',Auth::user()->id)->first();
        $categories = KrishiCategory::where('parent_id',0)->get();
        $productUnits = ProductUnit::all();
        return view('merchant.product.krishibaazar.create',compact('krishiId','categories','productUnits'));
    }

    public function addImages($images, $itemId){
        foreach($images as $index=>$img){
           $image = [
            'product_id' => $itemId,
            'sort'       => (int)$index+1,
            'org_img'    => Baazar::base64Uploadkrishi($img),
          ];
           KrishiProductItemImage::create($image);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,KrishiProduct $krishiProduct){
        // $request->validate([
        //     'thumbnail_image'   => 'required'
        // ]);
        $thumbnail_image = '';
        $shop_id = Shop::where('user_id',Auth::id())->where('type',Auth::user()->login_area)->first()->id;
        $slug = Baazar::getUniqueSlug($krishiProduct,$request->name);
        if($request->thumbnail_image){
            $thumbnail_image = Baazar::base64Uploadkrishi($request->thumbnail_image,$slug);
        }
        $allData=$request->all();
        $allData['slug']=$slug;
        $allData['thumbnail_image']=$thumbnail_image;
        $allData['available_to']=Carbon::create($request->available_from)->addDays($request->available_for)->format('Y-m-d');
        $allData['frequency_support']=$request->frequency_allow;
        $allData['frequency_quantity']=$request->frequency_quantity;
        $allData['user_id']=Auth::id();
        $allData['shop_id']=$shop_id;

        $krishiProduct = KrishiProduct::create($allData);

        if($request->images){
            $this->addImages($request->images['main'],$krishiProduct->id);
        }
        if(isset($request->allow_to_feed)){
            $newsfeed = new Newsfeed;
            $slug = Baazar::getUniqueSlug($newsfeed,$request->feed_title);
            $data = [
                'title'      => $request->feed_title,
                'slug'       => $slug,
                'image'      => Baazar::fileUpload($request,'feed_image','','/uploads/newsfeed_image'),
                'news_desc'  => $request->feed_desc,
                'user_id'    => Auth::user()->id,
                'created_at' => now(),
            ];
            Newsfeed::create($data);
        }

        Session::flash('success', 'Krishi Product Added Successfully!');
        return redirect()->action('KrishiProductController@index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KrishiProduct  $krishiProduct
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
       $krishiproduct = KrishiProduct::where('slug',$slug)->with('itemimage','reviews')->first();
       $reviews = $krishiproduct->onlyParentReviews()->get();
    //    $krishiproductImage = ItemImage::where('color_slug','main')->where('product_id',$krishiproduct->id)->where('type','krishi')->limit(5)->get();
       $rejectlist = Reject::where('type','krishi')->get();
        // dd($reviews);
       return view('merchant.product.krishibaazar.show',compact('krishiproduct','reviews','rejectlist'));
    }

    //  Krishi Product List in Admin Panel //
    public function krishiProductList(){
        $krishiproduct = KrishiProduct::distinct()->get();
        return view('merchant.product.krishibaazar.product_list',compact('krishiproduct'));
    }


    public function approvemetnt($slug){
        $data = KrishiProduct::where('slug',$slug)->first();
        $data->update(['status' => 'Active']);
        $name =  $data['name'];
        \Mail::to($data['email'])->send(new KrishiProductApprovemail($data, $name));
        Session::flash('success', 'Krishi Product Approve Successfully!');
        return back();
      }


    public function rejected(Request $request,$slug){
        $data = KrishiProduct::where('slug',$slug)->first();
        $data->update([
          'status' => 'Reject',
          'rej_desc' => $request->rej_desc,
        ]);

        $rejct_value = RejectValue::where('user_id', $data->user_id)->first();
        $rej_list = count($_POST['rej_name']);

        for($i = 0; $i<$rej_list; $i++){
            $rejct_value=RejectValue::create([
                'rej_name'      => $request->rej_name[$i],
                'type'          => $request->type,
                'merchant_id'   => $data->id,
                'user_id'       => $data->user_id,
            ]);
        }
        $rej_desc = RejectValue::where('type','krishi')->latest()->get();
        $name = $data['name'];
        // $rej_desc = $rejct_value['rej_name'];
        \Mail::to($data['email'])->send(new KrishiProductRejectMail($data, $name,$rej_desc));
        Session::flash('warning', 'Krishi Product Rejected Successfully!');
        return back();
    }


     //  Krishi Product List in Admin Panel End //

    public function edit($slug){
        $krishiproduct = KrishiProduct::where('slug',$slug)->firstOrFail();
        if (Auth::id() !== $krishiproduct->user_id){
            flash('Invaild product item')->error();
            return redirect()->action('KrishiProductController@index');
        }
        $frequencyname = [];
        if($krishiproduct->frequency_support == 1){
            $frequencyname = $krishiproduct->frequency;
        }
        $itemImages     = KrishiProductItemImage::where('product_id',$krishiproduct->id)->get();
        $categories     = KrishiCategory::where('parent_id',0)->get();
        $productUnits   = ProductUnit::all();

        return view('merchant.product.krishibaazar.edit',compact('krishiproduct','frequencyname','itemImages','categories','productUnits'));
    }

    public function update(Request $request, KrishiProduct $krishiProduct,$slug){

        $krishiProductDetails = KrishiProduct::where('slug',$slug)->firstOrFail();
        if (Auth::id() !== $krishiProductDetails->user_id){
            flash('Invaild product item')->error();
            return redirect()->action('KrishiProductController@index');
        }

        $krishiProductDetails->name=$request->name;
        $krishiProductDetails->description=$request->description;
        $krishiProductDetails->video_url=$request->video_url;
        $krishiProductDetails->available_from=$request->available_from;
        $krishiProductDetails->available_to=Carbon::create($request->available_from)->addDays($request->available_for)->format('Y-m-d');
        $krishiProductDetails->frequency_support=$request->frequency_allow;
        $krishiProductDetails->frequency_quantity=$request->frequency_quantity;
        $krishiProductDetails->available_stock=$request->available_stock;
        $krishiProductDetails->allow_custom_offer=$request->allow_custom_offer;
        $krishiProductDetails->frequency=$request->frequency;
        $krishiProductDetails->return_policy=$request->return_policy;
        $krishiProductDetails->product_unit_id=$request->product_unit_id;
        $krishiProductDetails->category_id=$request->category_id;

        if ($request->thumbnail_image){
            Storage::delete($krishiProductDetails->thumbnail_image);
            $krishiProductDetails->thumbnail_image=Baazar::base64Uploadkrishi($request->thumbnail_image,$slug);
        }

        $krishiProductDetails->save();
        //dropzone images unlink & restore
        $arr = [];
        foreach($krishiProductDetails->itemimage as $img){
            $arr[] = $img->org_img;
        }
        $krishiProductDetails->itemimage()->delete();
        foreach($request->images['main'] as $index=>$img){
            $newImg = Baazar::base64Uploadkrishi($img);
            if (($key = array_search($newImg, $arr)) !== false) {
                unset($arr[$key]);
            }
            $image = [
             'product_id' => $krishiProductDetails->id,
             'sort'       => (int)$index+1,
             'org_img'    => $newImg,
           ];
            KrishiProductItemImage::create($image);
         }
         if(count($arr) > 0){
            foreach($arr as $a){
                Storage::delete($a);
            }
         }

        Session::flash('success', 'Krishi Product Update Successfully!');
        return redirect()->action('KrishiProductController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KrishiProduct  $krishiProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $krishiId = KrishiProduct::find($id);
        $krishiId->delete();

        Session::flash('success', 'Krishi Product Deleted Successfully!');

        return redirect('merchant/krishi/products');
    }

    public function subCategoryChild(Request $request){
        $subCatId = $request->subCatId;
        return KrishiProduct::getSubcategoryChild($subCatId);
    }

    public function replayReview(Request $request){
        $request->validate([
            'review_msg'  => 'required',
            'krishi_product_id'  => 'required',
        ]);
        $images = $request->images;
        if($images){
            if(count($images) > 5){
                array_splice($images,5);
            }
        }
        $paths = [];
        if($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $name = \Str::slug($file->getClientOriginalName());
                $file->move(env('UP_DIR') . '/uploads/krishi/reviews/', $name);
                $paths[] = '/uploads/krishi/reviews/'.$name;
            }
        }
        KrishiReviews::create([
            // 'stars'             => '',
            'review_msg'        => $request->review_msg,
            'parent_id'         => $request->parent_id,
            'images'            => json_encode($paths),
            'krishi_product_id' => $request->krishi_product_id,
            'user_id'           => Auth::user()->id,
        ]);

        Session::flash('success','Comment posted successfully');
        return redirect()->back();

    }
}
