<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\KrishiProductCollection;
use App\Http\Resources\KrishiProductReviewCollection;
use App\Http\Resources\KrishiProductResource;
use App\Http\Traits\apiTrait;
use App\Models\KrishiProduct;
use App\Models\KrishiReviews;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class KrishiProductController extends Controller
{
    use apiTrait;

    public function product_details(Request $request){
        $product_details = KrishiProduct::with('itemimage')->find($request->productId);
        // dd($product_details);
        if (is_null($product_details)){
            return $this->jsonResponse([],'No product found',true);
        }
        return new KrishiProductResource($product_details);
    }

    public function related_products(Request $request){
        $validator=Validator::make($request->all(), [
            'productId'=>'required|numeric|exists:krishi_products,id',
        ]);

        if ($validator->fails()){
            return $this->jsonResponse([],$validator->messages()->first());
        }
        $product_details = KrishiProduct::find($request->productId);
        if (is_null($product_details)){
            return $this->jsonResponse([],'No related product found',true);
        }
        $related_products = KrishiProduct::where([['id','!=',$product_details->id],['category_id',$product_details->category_id],['status','Active'],['available_stock','>',0]])->whereDate('available_from','<=', Carbon::now())->take(10)->get();
        return new KrishiProductCollection($related_products);
    }

    public function product_reviews(Request $request){
        // $limit = 20;
        // if($request->limit){
        //     $limit = $request->limit;
        // }
        $reviews = KrishiReviews::where('krishi_product_id',$request->productId)->where('parent_id',0)->get();
        if (is_null($reviews)){
            return $this->jsonResponse([],'No product found',true);
        }
        // $reviews->appends(['productId' => $request->productId, 'limit'=>$limit]);
        return new KrishiProductReviewCollection($reviews);
    }
}
