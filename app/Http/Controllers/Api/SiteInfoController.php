<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\KrishiProductCategoryCollection;
use App\Http\Resources\KrishiProductCollection;
use App\Models\KrishiBazarSlider;
use App\Models\KrishiCategory;
use App\Models\KrishiProduct;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteInfoController extends Controller
{
    public function productCategories(){

    }

    public function sliderList(){
        $sliders = KrishiBazarSlider::select('slider_image','slider_url')->where('status',1)->get();
        return response()->json(['data'=>$sliders]);
    }

    public function risingStarShops(){
        $popularProducts = KrishiProduct::select('shop_id', DB::raw('SUM(total_unit_sold) as total_sold'))
            ->where('status','Active')
            ->groupBy('shop_id')
            ->orderBy('total_sold','desc')
            ->take(10)->get()
            ->pluck('shop_id')->all();
        $risingStarShops = Shop::whereIn('id',$popularProducts)->get();
        return new KrishiProductCategoryCollection($risingStarShops);
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
            ->where([['status','Active'],['available_stock','>',0]])
            ->groupBy('category_id')
            ->orderBy('total_sold','desc')
            ->take(10)->get()
            ->pluck('category_id')->all();
        $popularCategories = KrishiCategory::whereIn('id',$popularProducts)->where([['active',1],['parent_id',0]])->get();
        return new KrishiProductCategoryCollection($popularCategories);
    }

    public function newArrivalProducts(){
        $now = Carbon::now()->format('Y-m-d');
        $previous = Carbon::now()->subWeek()->format('Y-m-d');
        $newArrivalProducts = KrishiProduct::where([['status','Active'],['available_stock','>',0]])->whereDate('available_from','>=', $previous)->whereDate('available_to','<=', $now)->orderBy('available_from')->take(10)->get();
        return new KrishiProductCollection($newArrivalProducts);
    }

    public function upcomingProducts(){
        $upcomingProducts = KrishiProduct::where([['status','Active'],['available_stock','>',0]])->whereDate('available_from','>', Carbon::now())->orderBy('available_from')->take(8)->get();
        return new KrishiProductCollection($upcomingProducts);
    }

    public function topRatedProducts(){

    }
}
