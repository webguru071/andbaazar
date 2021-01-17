<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\KrishiProductCategoryCollection;
use App\Http\Resources\KrishiProductCollection;
use App\Http\Resources\KrishiProductFlashSaleCollection;
use App\Http\Resources\ShopCollection;
use App\Models\FlashSellSetting;
use App\Models\KrishiBazarSlider;
use App\Models\KrishiCategory;
use App\Models\KrishiProduct;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Traits\apiTrait;
use Illuminate\Support\Facades\DB;

class SiteInfoController extends Controller
{
    use apiTrait;
    public function productCategories(){
        $productCategories = KrishiCategory::where([['active',1],['parent_id',0]])->get();
        return new KrishiProductCategoryCollection($productCategories);
    }

    public function sliderList(){
        $sliders = KrishiBazarSlider::select('slider_image','slider_url')->where('status',1)->get();
        return $this->jsonResponse($sliders,'success',false);
    }

    public function risingStarShops(){
        $previous = Carbon::now()->subWeeks(8)->format('Y-m-d');
        $popularProducts = KrishiProduct::select('shop_id', DB::raw('SUM(total_unit_sold) as total_sold'))
            ->where('status','Active')
            ->whereDate('available_from','>=', $previous)
            ->groupBy('shop_id')
            ->orderBy('total_sold','desc')
            ->take(10)->get()
            ->pluck('shop_id')->all();
        $risingStarShops = Shop::whereIn('id',$popularProducts)->get();

        return new ShopCollection($risingStarShops);
    }

    public function shops(Request $request){
        $limit = 20;
        if($request->limit){
            $limit = $request->limit;
        }
        $shops = Shop::where('status','Active')->orderBy('id','desc')->paginate($limit);
        $shops->appends(['limit' => $limit]);
        return new ShopCollection($shops);
    }

    public function shopProducts(Request $request,$slug){
        $limit = 20;
        if($request->limit){
            $limit = $request->limit;
        }
        $shop = Shop::where('status','Active')->where('slug',$slug)->first();
        if(!$shop){
            return $this->jsonResponse([],'Shop not found', true);
        }
        $products = KrishiProduct::where('status','Active')->where('shop_id',$shop->id)->orderBy('id','desc')->paginate($limit);
        $products->appends(['limit' => $limit,'shop'=>$slug]);
        return new KrishiProductCollection($products);
    }

    public function flashDealProducts(){
        $flashSaleSetting=FlashSellSetting::whereTime('start_time','<=',Carbon::now())->whereTime('end_time','>=',Carbon::now())->where('status',1)->first();
        if (is_null($flashSaleSetting)){
            return $this->jsonResponse([],'No flash sale found', true);
        }
        $flashSaleProducts = KrishiProduct::where([['allow_flash_sale',1],['status','Active'],['available_stock','>',0]])->whereDate('available_from','<=', Carbon::now())->take(10)->get();
        $data = new KrishiProductFlashSaleCollection($flashSaleProducts);
        return $this->jsonResponse([
            'flash' => [
                'name' => $flashSaleSetting->name,
                'start' => $flashSaleSetting->start_time,
                'end'   => $flashSaleSetting->end_time
            ],
            'product_lists' => $data
        ],'success',false);
    }

    public function bestSellerProducts(){
        $bestSellerProducts= KrishiProduct::select('*', DB::raw('SUM(total_unit_sold) as total_sold'))
            ->where([['status','Active'],['available_stock','>',0]])
            ->orderBy('total_sold','desc')
            ->take(10)->get();
            return new KrishiProductCollection($bestSellerProducts);
    }

    public function popularCategories(){
        $popularProducts = KrishiProduct::select('category_id', DB::raw('SUM(total_unit_sold) as total_sold'))
            ->where([['status','Active']])
            ->groupBy('category_id')
            ->orderBy('total_sold','desc')
            ->take(6)->get()
            ->pluck('category_id')->all();
        $popularCategories = KrishiCategory::whereIn('id',$popularProducts)->where('active',1)->get();
        return new KrishiProductCategoryCollection($popularCategories);
    }

    public function newArrivalProducts(){
        $previous = Carbon::now()->subWeeks(4)->format('Y-m-d');
        $now = Carbon::now()->format('Y-m-d');
        $newArrivalProducts = KrishiProduct::where([['status','Active'],['available_stock','>',0]])->whereDate('available_from','>=', $previous)->whereDate('available_from','<=', $now)->orderBy('available_from')->take(10)->get();
        return new KrishiProductCollection($newArrivalProducts);
    }

    public function upcomingProducts(){
        $upcomingProducts = KrishiProduct::where([['status','Active'],['available_stock','>',0]])->whereDate('available_from','>', Carbon::now())->orderBy('available_from')->take(8)->get();
        return new KrishiProductCollection($upcomingProducts);
    }

    public function topRatedProducts(){

    }

    public function CategoryWiseProducts(Request $request,$parentCategory){
        $limit = 20;
        if($request->limit){
            $limit = $request->limit;
        }
        $cat = KrishiCategory::where('slug',$parentCategory)->first();
        $subCategories = $this->generateCategories($cat->childs);
        array_push($subCategories,(int)$cat->id);
        $products = KrishiProduct::whereIn('category_id', $subCategories)->where('status','active')->orderBy('id','desc')->paginate($limit);
        $products->appends(['limit'=>$limit]);
        return new KrishiProductCollection($products);
    }

    public function getSubCategories($slug){
        $parentCategory = KrishiCategory::where('slug',$slug)->first();
        return new KrishiProductCategoryCollection($parentCategory->childs);
    }

    public function getParentCategories($slug){
        $parentCategory = KrishiCategory::where('slug',$slug)->first();
        if(!$parentCategory){
            return $this->jsonResponse([],'Category not found', true);
        }
        $data = $parentCategory->parents->reverse();
        return new KrishiProductCategoryCollection($data->push($parentCategory));
    }

    public function search(Request $request){
        if(!$request->type){
            return $this->jsonResponse([],'Must select search type');
        }
        
        if(!$request->keyword){
            return $this->jsonResponse([],'Must select search keyword');
        }
        
        if($request->type === 'product' || $request->type === 'shop'){
            //start to search
            $limit = 20;
            if($request->limit){
                $limit = $request->limit;
            }
            $paginationMeta = ['type'=>$request->type,'keyword' => $request->keyword,'limit'=>$limit];
            $results = KrishiProduct::where('status','active');

            if($request->category){
                $cat = KrishiCategory::where('slug',$request->category)->first();
                if(!$cat){
                    return $this->jsonResponse([],'Invalid Category');
                }
                $results = $results->where('category_id',$cat->id);
                $paginationMeta = array_merge($paginationMeta,['category'=>$request->category]);
            }

            $results = $results->where(function($query) use ($request){
                    $query->orWhere('slug','like','%'.$request->keyword.'%')
                          ->orWhere('return_policy','like','%'.$request->keyword.'%')
                          ->orWhere('description','like','%'.$request->keyword.'%')
                          ->orWhere('name','like','%'.$request->keyword.'%');
                });

            if($request->type === 'shop'){ //find & return shops
                $results = $results->groupBy('shop_id')->select('shop_id')->pluck('shop_id');//->first();
                $shops = Shop::whereIn('id', $results)->orderBy('id','desc')->where('status','active')->paginate($limit);
                $shops->appends($paginationMeta);
                return new ShopCollection($shops);
            }
            $results = $results->orderBy('id','desc')->paginate($limit);
            
            // dd($results);
            $results->appends($paginationMeta);
            return new KrishiProductCollection($results);
        }else{
            return $this->jsonResponse([],'Invalid search type');
        }

    }
}
