<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\KrishiProductCategoryCollection;
use App\Http\Resources\KrishiProductCollection;
use App\Http\Resources\ShopCollection;
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
        return $this->jsonResponse($sliders,'success');
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

    public function flashDealProducts(){

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

    public function CategoryWiseProducts(Request $request,$parentCategoryId){
        $limit = 20;
        if($request->limit){
            $limit = $request->limit;
        }
        $parentCategory = KrishiCategory::find($parentCategoryId);
        $subCategories = $this->generateCategories($parentCategory->childs);
        array_push($subCategories,(int)$parentCategoryId);
        $products = KrishiProduct::whereIn('category_id', $subCategories)->where('status','active')->orderBy('id','desc')->paginate($limit);
        $products->appends(['limit'=>$limit]);
        return new KrishiProductCollection($products);
    }

    public function getSubCategories($parentCategoryId){
        $parentCategory = KrishiCategory::find($parentCategoryId);
        return new KrishiProductCategoryCollection($parentCategory->childs);
    }

    public function search(Request $request){
        if(!$request->type){
            return $this->jsonResponse([],'Must select search type');
        }
        
        if(!$request->keyword){
            return $this->jsonResponse([],'Must select search keyword');
        }
        
        if($request->type === 'product' || $request->type === 'shop'){
            if($request->category){
                $cat = KrishiCategory::find($request->category);
                if(!$cat){
                    return $this->jsonResponse([],'Invalid Category');
                }
            }
            
            //start to search
            $limit = 20;
            if($request->limit){
                $limit = $request->limit;
            }
            $results = KrishiProduct::where('category_id',$request->category)
                ->where('name','like','%'.$request->keyword.'%')
                ->orWhere('description','like','%'.$request->keyword.'%')
                ->orWhere('slug','like','%'.$request->keyword.'%')
                ->orWhere('return_policy','like','%'.$request->keyword.'%');

            if($request->type === 'shop'){ //find & return shops
                $results = $results->groupBy('shop_id')->select('shop_id')->pluck('shop_id');//->first();
                $shops = Shop::whereIn('id', $results)->orderBy('id','desc')->where('status','active')->paginate($limit);
                $shops->appends(['type'=>$request->type,'keyword' => $request->keyword,'category'=>$request->category,'limit'=>$limit]);
                return new ShopCollection($shops);
            }
            $results = $results->orderBy('id','desc')->where('status','active')->paginate($limit);
            $results->appends(['type'=>$request->type,'keyword' => $request->keyword,'category'=>$request->category,'limit'=>$limit]);
            return new KrishiProductCollection($results);
        }else{
            return $this->jsonResponse([],'Invalid search type');
        }

    }
}
