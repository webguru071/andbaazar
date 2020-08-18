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
use Illuminate\Support\Str;
use App\Models\Brand;
use App\Models\Reject;
use App\Models\RejectValue;
use Sentinel;
use Session;
use Baazar;
use App\Models\Newsfeed;

class ProductsController extends Controller
{
    public function __construct(){
      // $this->middleware('auth');//->except('store');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
      $filter = [
        'category'  => '',
        'status'  => '',
        'keyword'  => '',
      ];
      $findCat = Product::where('shop_id',Baazar::shop()->id);
      $categories = $findCat->select('category_id')->with('category')->distinct()->get();

      $product = Product::where('shop_id',Baazar::shop()->id);

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

      $product = $product->paginate(10);
      $product = $product->withPath("products?keyword={$filter['keyword']}&category={$filter['category']}&status={$filter['status']}");
      return view ('merchant.product.index',compact('product','categories','filter'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $category = Category::where('type','ecommerce')->get(); 
        $item = Product::all();
        $size= Size::all();
        $color = Color::all();
        $categories = Category::where('parent_id',0)->where('type','ecommerce')->get();
        $subCategories = Category::where('parent_id','!=',0)->get();
        $childCategory = Category::where('parent_id','!=',0)->get();
        $tag = Tag::all();
        $sellerId = Merchant::where('user_id',Sentinel::getUser()->id)->first();
        $shopProfile = Shop::where('user_id',Sentinel::getUser()->id)->first();
  

        return view ('merchant.product.create',compact('category','categories','item','size','color','subCategories','tag','sellerId','shopProfile','childCategory'));
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
          'type'            => 'ecommerce',
          'shop_id'         => $shopId,
          'user_id'         => Sentinel::getUser()->id,
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

    public function addAttributes($attributes,$itemId){
      foreach($attributes as $id=>$att){
        $metas = [
          'attr_label'    => $id,
          'attr_value'    => $att,
          'attribute_id'  => $id,
          'product_id'    => $itemId,
        ];
        ItemMeta::create($metas);
      }
    }

    public function addImages($images, $itemId,$shop){
      foreach($images as $color => $image){
        foreach($image as $img){
          $cID = Color::where('slug',$color)->first();
          $i = 0;
          $image = [
            'product_id' => $itemId,
            'color_slug' => $color,
            'color_id'   => $cID ? $cID->id : 0,
            'sort'       => ++$i,
            'org_img'    => Baazar::base64Upload($img,'orgimg',$shop->slug,$color),
          ];
          ItemImage::create($image);
        }
      }
    }

    public function store(Product $item, Request $request, Newsfeed $newsfeed){
      // dd($request->all());
      $shop = Merchant::where('user_id',Sentinel::getUser()->id)->first()->shop;
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
              'type'          => 'ecommerce',
              'bn_description'=> $request->bn_description,            
              'made_in'       => $request->made_in,
              'materials'     => $request->materials,
              'video_url'     => $request->video_url,
              'category_id'   => $request->category_id,
              'category_slug' => $request->category,
              'brand_id'      => $request->brand_id,
              'tag_slug'      => $this->tagSlug($request->tag_id),
              'status'        => 'Pending',
              'shop_id'       => $shop->id,
              'user_id'       => Sentinel::getUser()->id,
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
          'user_id'    => Sentinel::getUser()->id,
          'created_at' => now(),
        ];

        Newsfeed::create($newsFeed);


        // $name = $data['name'];
        //  \Mail::to($sellerId['email'])->send(new ProductApproveRequestMail($sellerId, $name));
        Session::flash('success', 'Product Added Successfully!');
       }else{
        return view('vendor-deshboard');
       }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product){
        $product      = Product::with('itemimage')->where('slug',$product->slug)->where('type','ecommerce')->first();
        $productImage = ItemImage::where('color_slug','main')->where('product_id',$product->id)->limit(5)->get();
        //dd($productImage);
        $shopProfile = Shop::where('user_id',Sentinel::getUser()->id)->first();
        $productCapasize = InventoryMeta::where('product_id',$product->id)->get();
        $imageColor  = ItemImage::select('color_slug')->where('color_slug','!=','main')->where('product_id',$product->id)->distinct()->get();
        $rejectlist = Reject::where('type','product')->get();
        // dd($imageColor);

        return view('merchant.product.show',compact('product','shopProfile','productImage','productCapasize','imageColor','rejectlist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug){
        $product = Product::with(['item_meta.attributes.options','news','itemimage','inventory.invenMeta','category.inventoryAttributes.options'])->where('slug',$slug)->first(); 
        $itemImages = $product->itemimage->groupBy('color_slug'); 
        // dd($newsFeed);
        // dd($product->category->inventoryAttributes);
        // dd($product->inventory);
        // echo 'asdf';
        // $itemimg           = \DB::table('item_images')
        //                       ->where('product_id',$product->id)
        //                       ->select('color_slug', \DB::raw('count(*) as total'))
        //                       ->groupBy('color_slug')
        //                       ->where('deleted_at',NULL)
        //                       ->get();
        // dd($itemimg);
        //dd( $product);

        $category           = Category::all();
        $item               = Product::all();
        $size               = Size::all();
        $color              = Color::all();
        $categories         = Category::where('parent_id',0)->where('type','ecommerce')->get();
        $subCategories      = Category::where('parent_id','!=',0)->get();
        $tag                = Tag::all(); 
        $selected_tags      = [];
        foreach($product->itemtag as $tags){
          $selected_tags[$tags->id] = $tags; 
        }
        $shopProfile        = Shop::where('user_id',Sentinel::getUser()->id)->first();
        $productInventories = Inventory::where('product_id',$product->id)->get();
        $porductMeta        = ItemMeta::where('product_id',$product->id)->get();
        //dd($porductMeta);
        $brand = Brand::all();
        //dd($brand);
       

        return view ('merchant.product.edit',compact('brand','category','itemImages','categories','selected_tags','item','productInventories','size','color','subCategories','product','tag','shopProfile'));
    }

    
   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug,Product $item){ 
      $product        = Product::where('slug',$slug)->first(); 
      $newsFeedUpdate = Newsfeed::where('product_id',$product->id)->first(); 
      $product->item_meta()->delete(); 
      $product->itemimage()->delete();
      $product->inventory()->delete();
      $shop = Merchant::where('user_id',Sentinel::getUser()->id)->first()->shop;
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

        if($request->attribute){ 
          $this->addAttributes($request->attribute,$product->id);
        }
        if($request->images){
          $this->addImages($request->images,$product->id,$shop);
        } 
        $newsFeed = [
          'title'      => $request->title,
          'image'      => Baazar::fileUpload($request,'image','old_image','/uploads/newsfeed_image'),
          'news_desc'  => $request->news_desc,  
          'updated_at' => now(),
        ];
        $newsFeedUpdate->update($newsFeed);
        Session::flash('success', 'Product updated Successfully!');

        return back();
    }


    public function clear($id){
       return redirect('merchant/products');
  }


    public function productList(){ 
        $items = Product::with('inventory')->where('type','ecommerce')->distinct()->get();  
       
     return view('merchant.product.product_list',compact('items'));
    }

    public function productTableList(){
      // $product = Product::all();
      $ecom = Product::with('inventory')->where('type','ecommerce')->get(); 
      $sme = Product::with('inventory')->where('type','sme')->get(); 
      return view('merchant.product.productTableList',compact('ecom','sme'));
    }

     public function approvement($slug){

      $data = Product::where('slug',$slug)->first();

      $newsFeed = Newsfeed::where('product_id',$data->id)->first();

      $data->update(['status' => 'Active']);
      $newsFeed->update(['status' => 'Active']);

      $name =  $data['name'];
      \Mail::to($data['email'])->send(new productApproveMail($data, $name));
      Session::flash('success', 'Product Approve Successfully!');

        return back();

    }


    public function rejected(Request $request,$slug){


      $data = Product::where('slug',$slug)->first();
      //dd( $data);
      $newsFeed = Newsfeed::where('product_id',$data->id)->first();
      //dd( $newsFeed);


      $data->update([
        'status' => 'Reject',
        'rej_desc' => $request->rej_desc,
        ]);

        $newsFeed->update([
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
      \Mail::to($data['email'])->send(new ProductRejectMail($data, $name,$rej_desc));
      Session::flash('warning', 'Product Rejected Successfully!');

        return back();

    }

    public function subcategory(Request $request){
      $categoryId = $request->categoryId;
      return Product::getSubcategory($categoryId);
    }

    public function subCategoryChild(Request $request){
      $subCatId = $request->subCatId;
      return Product::getSubcategoryChild($subCatId);
    }

    public function childCategory(Request $request){
      $childCatId = $request->childCatId;
      return Product::getChildCategory($childCatId);
    }

    public function childCategory1(Request $request){
      $childCatid_1 = $request->childCatid_1;
      return Product::getChildCategory1($childCatid_1);
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


        Session::flash('error', 'Product Deleted Successfully');

         return redirect('merchant/product');
    }

    public function vendorshow($slug){

    //  $product = Product::with('category')->where('user_id',Sentinel::getUser()->id)->first();
      $product = Product::with(['category','itemimage'])->where('slug',$slug)->first();
      $shopProfile = Shop::where('user_id',Sentinel::getUser()->id)->first();
      return view('merchant.product.vendorshow',compact('product','shopProfile'));
    }

    public function colorWiseImage(Request $request){
      $imgcolor = $request->imgcolor;
      return Product::getColorWiseImage($imgcolor);
    }

    public function getBrand(Request $request){
      // dd($request->all());
      $category = Category::find($request->cat);
      $option = '<option value="">No Brand</option>';
      if(!empty($category)){
        $brands = $category->brands;
        if($brands){
          foreach($brands as $brand){
            $option .= "<option value='{$brand->id}'>{$brand->name}</option>";
          }
        }
      }
      echo $option ;
    }

    public function deleteInventory(Request $request){
      //dd($request->all());
      $productId       = $request->productId;
      //dd($productId);
      //$deleteInventory = DB::table('inventories')->where('product_id',$productId)->delete();
      // return "inventorey Successfully Deleted";
      return Product::deleteInventory($productId);
    }



    // private function validateForm($request){
    //     $validatedData = $request->validate([
    //         'name' => 'required',
    //         'emial'=> 'required',
    //         'price' => 'required',
    //         'model_no' => 'required',
    //         'org_price' => 'required',
    //         'pack_id' => 'required',
    //         'min_order'=> 'required',
    //         'made_in' => 'required',
    //         'materials'=> 'required',
    //         'labeled' => 'required',
    //         // 'available_on' => 'required',
    //         // 'availability' => 'required',
    //         // 'activated_at' => 'required',


    //     ]);
    // }
}
