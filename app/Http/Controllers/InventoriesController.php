<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Merchant;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\ItemImage;
use App\Models\Color;
use App\Models\Size;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use Session;
use Baazar;
use App\Models\InventoryAttributeOption;
use App\Models\InventoryMeta;
use App\Models\InventoryAttribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class InventoriesController extends Controller {

    public function index(Request $request){
        $select['product'] = 'all';
        $inventories        = Inventory::where('shop_id',Baazar::shop()->id)->with('item')->where('type','ecommerce');
        $inventoriesOutStock        = Inventory::where('shop_id',Baazar::shop()->id)->with('item')->where('type','ecommerce');
        $products = Product::where('shop_id',Baazar::shop()->id)->where('type','ecommerce')->get();
        if($request->has('product')){
            $product = Product::where('slug',$request->product)->first();
            if($product){
                $inventories = $inventories->where('product_id',$product->id);
                $inventoriesOutStock = $inventoriesOutStock->where('product_id',$product->id);
            }
            $select['product'] = $request->product;
        }
        $inventories = $inventories->orderBy('product_id')->where('qty_stock','>',0)->paginate(20)->withPath("inventories?product={$select['product']}");
        $inventoriesOutStock = $inventoriesOutStock->orderBy('product_id')->where('qty_stock','<=',0)->paginate(20)->withPath("inventories?product={$select['product']}");

        return view ('merchant.inventory.ecommerceInventroy.index',compact('inventories','products','select','inventoriesOutStock'));//,'item','color','inventoryAttriSize','productAttriSize','inventoryAttriCapa','productAttriCapa'));
    }

    public function create(){
        // $inventory          = Inventory::all();
        $item               = Product::where('user_id',Auth::user()->id)->where('type','ecommerce')->get();
        // $shopProfile        = Shop::where('user_id',Auth::user()->id)->first();
        // $size               = Size::all();
        $color              = Color::all();
        // $inventoryAttriSize = InventoryAttributeOption::with('attribute')->where('inventory_attribute_id',1)->first();
        // $inventoryAttriCapa = InventoryAttributeOption::with('attribute')->where('inventory_attribute_id',2)->first();
        // $productAttriSize   = InventoryAttributeOption::where('inventory_attribute_id',1)->get();
        // $productAttriCapa   = InventoryAttributeOption::where('inventory_attribute_id',2)->get();
        return view ('merchant.inventory.ecommerceInventroy.create',compact('inventory','item','size','color','shopProfile','productAttriSize','productAttriCapa','inventoryAttriSize','inventoryAttriCapa'));
    }

    public function addImages($images, $itemId,$shop){
        foreach($images as $color => $image){
            ItemImage::where('color_slug',$color)->where('product_id',$itemId)->forceDelete();
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


    public function store(Inventory $inventory,Request $request){
        // dd($request->all());
        $shopId = Shop::where('user_id',Auth::user()->id)->first();
        $product = Product::with('itemimage')->where('id',$request->product_id)->first();
        $this->validateForm($request);
        $slug = Baazar::getUniqueSlug($inventory, $product->name);
        $shop = Merchant::where('user_id',Auth::user()->id)->first()->shop;
        $cID = Color::where('slug',$request->color_name)->first();
        if($shop){
            $data = [
                'product_id'    => $request->product_id,
                'slug'          => Str::slug($slug.'-'.$product->id.$request->color_name.rand(1000,10000)),//Str::slug($slug.'-'.rand(1000,10000)),
                'color_name'    => $request->color_name,
                'color_id'      => $cID ? $cID->id : 0,
                'size_id'       => $request->size_id,
                'price'         => $request->price,
                'qty_stock'     => $request->qty_stock,
                'special_price' => $request->special_price,
                'start_date'    => $request->start_date,
                'end_date'      => $request->end_date,
                'type'          => 'ecommerce',
                'shop_id'       => $shopId->id,
                'user_id'       => Auth::user()->id,
                'created_at'    => now(),
            ];

            $inventory = Inventory::create($data);

            if($request->has('inventoryAttr')){
                foreach($request->inventoryAttr as $iname => $ival){
                    $inventoryAtti = [
                        'name'        => $iname,
                        'value'       => $ival,
                        'inventory_id'=> $inventory->id,
                        'product_id'  => $inventory->product_id,
                    ];
                    InventoryMeta::create($inventoryAtti);
                }
            }


            if($request->images){
                $this->addImages($request->images,$inventory->product_id,$shop);
            }
            Session::flash('success', 'Inventory Added Successfully!');
        }
        return redirect('merchant/e-commerce/inventories');
    }

    public function show(Inventory $inventory){
        return view ('merchant.inventory.ecommerceInventroy.show',compact('inventory'));
    }

    public function edit($slug){
        $inventory          = Inventory::with(['item.itemimage','item.category.inventoryAttributes.options','color','invenMeta'])->where('slug',$slug)->where('type','ecommerce')->first();
        $itemImages         = $inventory->item->itemimage->where('product_id',$inventory->product_id)->where('color_id',$inventory->color_id)->groupBy('color_slug')->toArray();
        return view ('merchant.inventory.ecommerceInventroy.edit',compact('inventory','itemImages'));
    }


    public function update(Request $request,$slug){
        // dd($request->all());
        $inventory  = Inventory::where('slug',$slug)->first();
         $shop = Merchant::where('user_id',Auth::user()->id)->first()->shop;
        $this->validateForm($request);
        $data = [
            'size_id'       => $request->size_id,
            'price'         => $request->price,
            'qty_stock'     => $request->qty_stock,
            'seller_sku'    => $request->seller_sku,
            'special_price' => $request->special_price,
            'start_date'    => $request->start_date,
            'end_date'      => $request->end_date,
            'updated_at'    => now(),
        ];
        $inventory->update($data);
        if($request->has('inventoryAttr')){
            foreach($request->inventoryAttr as $iname => $ival){
                $inventMeta = InventoryMeta::where('inventory_id',$inventory->id)->where('name', $iname)->first();
                $inventMeta->update([
                    'value'       => $ival,
                ]);
            }
        }
        if($request->images){
            $this->addImages($request->images,$inventory->product_id,$shop);
        }
        Session::flash('success', 'Inventory update Successfully!');
        return redirect('merchant/e-commerce/inventories');
    }


    public function destroy($id){
        $inventory = Inventory::find($id);
        $inventory->delete();
        Session::flash('success', 'Inventory Deleted Successfully!');
        return redirect('merchant/e-commerce/inventories');
    }



    private function validateForm($request){
        $validatedData = $request->validate([
            //'product_id' => 'required',
            //'color_name' => 'required',
            'qty_stock'  => 'required',
            'price'      => 'required',
            // 'size_id' => 'required',
        ]);
    }

    public function inventoryColor(Request $request){
        $color = $request->color;
        $item  = $request->item;
        $inventory =  ItemImage::where('color_slug',$color)->where('product_id',$item);
        $count = $inventory->count();
        $images = $inventory->get()->toArray();
        echo json_encode(['count' => $count,'images' => $images]);

    }
}
