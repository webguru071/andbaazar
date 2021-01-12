<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\KrishiProductCollection;
use App\Http\Resources\KrishiProductResource;
use App\Http\Traits\apiTrait;
use App\Models\KrishiProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class KrishiProductController extends Controller
{
    use apiTrait;

    public function product_details(Request $request){
        $product_details = KrishiProduct::find($request->productId);
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
        $related_products = KrishiProduct::where([['category_id',$product_details->category_id],['status','Active'],['available_stock','>',0]])->whereDate('available_from','<=', Carbon::now())->take(10)->get();
        return new KrishiProductCollection($related_products);
    }
}
