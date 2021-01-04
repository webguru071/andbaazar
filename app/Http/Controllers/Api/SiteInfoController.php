<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\KrishiProductCollection;
use App\Models\KrishiBazarSlider;
use App\Models\KrishiProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SiteInfoController extends Controller
{
    public function productCategories(){

    }

    public function sliderList(){
        $sliders = KrishiBazarSlider::select('slider_image','slider_url')->where('status',1)->get();
        return response()->json(['data'=>$sliders]);
    }

    public function risingStarShops(){

    }

    public function flashDealProducts(){

    }

    public function bestSellerProducts(){

    }

    public function popularCategories(){

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
