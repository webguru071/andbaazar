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
        return $this->jsonResponse(new KrishiProductCategoryCollection($productCategories));
    }

    public function sliderList(){
        $sliders = KrishiBazarSlider::select('slider_image','slider_url')->where('status',1)->get();
        return $this->jsonResponse($sliders);
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

        return $this->jsonResponse(new ShopCollection($risingStarShops));
    }

    public function flashDealProducts(){

    }

    public function bestSellerProducts(){
        $bestSellerProducts= KrishiProduct::select('*', DB::raw('SUM(total_unit_sold) as total_sold'))
            ->where([['status','Active'],['available_stock','>',0]])
            ->orderBy('total_sold','desc')
            ->take(10)->get();
            return $this->jsonResponse(new KrishiProductCollection($bestSellerProducts));
    }

    public function popularCategories(){
        $popularProducts = KrishiProduct::select('category_id', DB::raw('SUM(total_unit_sold) as total_sold'))
            ->where([['status','Active']])
            ->groupBy('category_id')
            ->orderBy('total_sold','desc')
            ->take(10)->get()
            ->pluck('category_id')->all();
        $popularCategories = KrishiCategory::whereIn('id',$popularProducts)->where([['active',1],['parent_id',0]])->get();
        return $this->jsonResponse(new KrishiProductCategoryCollection($popularCategories));
    }

    public function newArrivalProducts(){
        $previous = Carbon::now()->subWeeks(4)->format('Y-m-d');
        $newArrivalProducts = KrishiProduct::where([['status','Active'],['available_stock','>',0]])->whereDate('available_from','>=', $previous)->orderBy('available_from')->take(10)->get();
        return $this->jsonResponse(new KrishiProductCollection($newArrivalProducts));
    }

    public function upcomingProducts(){
        $upcomingProducts = KrishiProduct::where([['status','Active'],['available_stock','>',0]])->whereDate('available_from','>', Carbon::now())->orderBy('available_from')->take(8)->get();
        return $this->jsonResponse(new KrishiProductCollection($upcomingProducts));
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
        return $this->jsonResponse(new KrishiProductCollection($products));
    }

    public function getSubCategories($parentCategoryId){
        $parentCategory = KrishiCategory::find($parentCategoryId);
        return $this->jsonResponse(new KrishiProductCategoryCollection($parentCategory->childs));
    }
}
