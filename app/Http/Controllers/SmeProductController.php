<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\ProductApproveRequestMail;
use App\Mail\productApproveMail;
use App\Mail\ProductRejectMail;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use App\Models\Color;
use App\Models\Merchant;
use App\Models\ProductCategory;
use App\Models\ProductTag;
use App\Models\Tag;
use App\Models\ItemImage;
use App\Models\Shop;
use App\Models\Inventory;
use App\Models\InventoryMeta;
use App\Models\ItemMeta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Brand;
use App\Models\Newsfeed;
use Session;
use Baazar;
use App\Models\Reject;
use App\Models\RejectValue;

class SmeProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sellerProfile = Merchant::with('rejectvalue')->where('user_id',Auth::user()->id)->first();
        $product = Product::where('shop_id',Baazar::shop()->id)->where('type','sme')->paginate(10);
        $rejectReason = RejectValue::where('user_id',Auth::user()->id)->where('type','sme')->get();

      // $items = Product::with('inventory')->paginate('10');


     if ($request->has('cat')){

        $product = Product::where('shop_id',Baazar::shop()->id)->where('category_slug','like','%'.$request->cat.'%')->where('type','sme')->paginate(10);
    }

    if ($request->has('status')){
      $product =Product::orderBy('status','asc')->Where('status',$request->status)->where('type','sme')->paginate(10);
    // dd($product);
  }
    $categories = ([
      'cat'      =>request('cat'),
      'status'   => request('status'),
  ]);

      return view ('merchant.product.smeProduct.index',compact('product','sellerProfile','rejectReason'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        $item = Product::all();
        $size= Size::all();
        $color = Color::all();
        $categories = Category::where('parent_id',0)->where('type','sme')->get();
        $subCategories = Category::where('parent_id','!=',0)->get();
        $childCategory = Category::where('parent_id','!=',0)->get();
        $tag = Tag::all();
        $sellerId = Merchant::where('user_id',Auth::user()->id)->first();
        $shopProfile = Shop::where('user_id',Auth::user()->id)->first();
        return view ('merchant.product.smeProduct.create',compact('category','categories','item','size','color','subCategories','tag','sellerId','shopProfile','childCategory'));
    }


    public function tagSlug($tags){
      $slug = '';
      foreach($tags as $tag){
        $slug .= $tag.',';
      }
      $slug = rtrim($slug,',');
      return $slug;
    }


    public function addInventory($request,$itemId,$shopId,$slug){
        $i = 0;
        foreach($request->inventory_price as $row){
          if($request->inventory_color){
            $color = Color::where('name',$request->inventory_color[$i])->first()->toArray();
          }else{
            $color['id'] = 0;
            $color['name'] = 'no color';
          }
          $inventories = [
            'product_id'      => $itemId,
            'slug'            => Str::slug($slug.'-'.$itemId.$color['name'].rand(1000,10000)),
            'color_id'        => $color['id'],
            'color_name'      => $color['name'],
            'qty_stock'       => is_numeric($request->inventory_qty[$i])?$request->inventory_qty[$i]:0,
            'price'           => is_numeric($request->inventory_price[$i])?$request->inventory_price[$i]:0,
            'special_price'   => is_numeric($request->special_price[$i])?$request->special_price[$i]:0,
            'start_date'      => $request->startday[$i],
            'end_date'        => $request->endday[$i],
            'seller_sku'      => $request->seller_sku[$i],
            'type'            => 'sme',
            'shop_id'         => $shopId,
            'user_id'         => Auth::user()->id,
            'created_at'      => now(),
          ];
          $inventory = Inventory::create($inventories);
          if($request->inventoryAttr){
            foreach($request->inventoryAttr as $att=>$val){
                $inventory_meta = [
                  'name'        => $att,
                  'value'       => $val[$i],
                  'inventory_id'=> $inventory->id,
                  'product_id'  => $itemId,
                ];
                InventoryMeta::create($inventory_meta);
            }
          }
          $i++;
        }
      }

      public function addImages($images, $itemId,$shop){
        foreach($images as $color => $image){
          foreach($image as $img){
            $i = 0;
            $image = [
              'product_id' => $itemId,
              'color_slug' => $color,
              'sort'       => ++$i,
              'type'       => 'sme',
              'org_img'    => Baazar::base64Upload($img,'orgimg',$shop->slug,$color),
            ];
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
    public function store(Product $item, Request $request, Newsfeed $newsfeed)
    {
        $shop = Merchant::where('user_id',Auth::user()->id)->first()->shop;
        $newsslug = Baazar::getUniqueSlug($newsfeed,$request->title);
        if($shop){
          $slug = Baazar::getUniqueSlug($item,$request->name);
          $feature = Baazar::base64Upload($request->images['main'][0],$slug,$shop->slug,'featured');
            $data = [
                'name'          => $request->name,
                'bn_name'       => $request->bn_name,
                'slug'          => $slug,
                'image'         => $feature,
                'price'         => is_numeric($request->price)?$request->price:0,
                'model_no'      => $request->model_no,
                'org_price'     => is_numeric($request->org_price)?$request->org_price:0,
                'description'   => $request->description,
                'email'         => $request->email,
                'bn_description'=> $request->bn_description,
                'type'          => 'sme',
                'made_in'       => $request->made_in,
                'materials'     => $request->materials,
                'video_url'     => $request->video_url,
                'category_id'   => $request->category_id,
                'category_slug' => $request->category,
                'tag_slug'      => $this->tagSlug($request->tag_id),
                'status'        => 'Pending',
                'shop_id'       => $shop->id,
                'user_id'       => Auth::user()->id,
                'created_at'    => now(),
            ];
          $item = Product::create($data);
          $this->addInventory($request,$item->id,$shop->id,$item->slug);
          if($request->attribute){
            $this->addAttributes($request->attribute,$item->id);
          }
          if($request->images){
            $this->addImages($request->images,$item->id,$shop);
          }

        $newsFeed = [
          'title'      => $request->title,
          'slug'       => $newsslug,
          'image'      => Baazar::fileUpload($request,'image','','/uploads/newsfeed_image'),
          'news_desc'  => $request->news_desc,
          'product_id' => $item->id,
          'user_id'    => Auth::user()->id,
          'created_at' => now(),
        ];

        Newsfeed::create($newsFeed);

          // $name = $data['name'];
          //  \Mail::to($sellerId['email'])->send(new ProductApproveRequestMail($sellerId, $name));
          Session::flash('success', 'SME Product Added Successfully!');
         }else{
          return view('vendor-deshboard');
         }
         return redirect('merchant/sme/product');
          // return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product){
      $product      = Product::with('itemimage')->where('slug',$product->slug)->where('type','sme')->first();
      $productImage = ItemImage::where('color_slug','main')->where('product_id',$product->id)->limit(5)->get();
      //dd($productImage);
      $shopProfile = Shop::where('user_id',Auth::user()->id)->first();
      $productCapasize = InventoryMeta::where('product_id',$product->id)->get();
      $imageColor  = ItemImage::select('color_slug')->where('color_slug','!=','main')->where('product_id',$product->id)->distinct()->get();
      $rejectlist = Reject::where('type','product')->get();
      // dd($imageColor);

      return view('merchant.product.smeProduct.show',compact('product','shopProfile','productImage','productCapasize','imageColor','rejectlist'));
  }

  public function smeproductList(){
    $items = Product::with('inventory')->where('type','sme')->get();
   return view('merchant.product.smeProduct.product_list',compact('items'));
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug){
      $product = Product::with(['item_meta.attributes.options','itemimage','inventory.invenMeta','category.inventoryAttributes.options'])->where('slug',$slug)->first();
      $itemImages = $product->itemimage->groupBy('color_slug');
      $category           = Category::all();
      $item               = Product::all();
      $size               = Size::all();
      $color              = Color::all();
      $categories         = Category::where('parent_id',0)->get();
      $subCategories      = Category::where('parent_id','!=',0)->get();
      $tag                = Tag::all();
      $selected_tags      = [];
      foreach($product->itemtag as $tags){
        $selected_tags[$tags->id] = $tags;
      }
      $shopProfile        = Shop::where('user_id',Auth::user()->id)->first();
      $productInventories = Inventory::where('product_id',$product->id)->get();
      $porductMeta        = ItemMeta::where('product_id',$product->id)->get();
      //dd($porductMeta);
      return view ('merchant.product.smeProduct.edit',compact('category','itemImages','categories','selected_tags','item','productInventories','size','color','subCategories','product','tag','shopProfile'));
  }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug,Product $item){
      $product = Product::where('slug',$slug)->first();
      $newsFeedUpdate = Newsfeed::where('product_id',$product->id)->first();
      $product->item_meta()->delete();
      $product->itemimage()->delete();
      $product->inventory()->delete();
      $shop = Merchant::where('user_id',Auth::user()->id)->first()->shop;
      $feature = Baazar::base64Upload($request->images['main'][0],$slug,$shop->slug,'featured');
        $data = [
          'name'          => $request->name,
          'bn_name'       => $request->bn_name,
          'image'         => $feature,
          'price'         => is_numeric($request->price)?$request->price:0,
          'model_no'      => $request->model_no,
          'org_price'     => is_numeric($request->org_price)?$request->org_price:0,
          'description'   => $request->description,
          'email'         => $request->email,
          'bn_description'=> $request->bn_description,
          // 'min_order'     => $request->min_order,
          'made_in'       => $request->made_in,
          'materials'     => $request->materials,
          'video_url'     => $request->video_url,
          'category_id'   => $request->category_id,
          'category_slug' => $request->category,
          'brand_id'      => $request->brand_id,
          'tag_slug'      => $this->tagSlug($request->tag_id),
          'updated_at'    => now(),
        ];

        $product->update($data);
        $this->addInventory($request,$product->id,$shop->id,$product->slug);

        if($request->images){
          $this->addImages($request->images,$product->id,$shop);
        }


        Session::flash('success', 'SME Product updated Successfully!');

        return redirect('merchant/sme/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
      $product = Product::find($id);
      $product->itemimage()->delete();
      $product->inventory()->delete();
      $product->delete();

      Session::flash('error', 'SME Product Deleted Successfully');

      return redirect('/merchant/sme/products');
  }
}
