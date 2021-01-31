<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KrishiProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KrishiProductController extends Controller
{
    public function activeProducts(){
        $active_krishi_products = KrishiProduct::where('status','Active')->get();
        return view('admin.krishi_baazar.product.active',compact('active_krishi_products'));
    }

    public function pendingProducts(){
        $pending_krishi_products = KrishiProduct::where('status','Pending')->get();
        return view('admin.krishi_baazar.product.pending',compact('pending_krishi_products'));
    }

    public function rejectedProducts(){
        $rejected_krishi_products = KrishiProduct::where('status','Reject')->get();
        return view('admin.krishi_baazar.product.rejected',compact('rejected_krishi_products'));
    }

    public function upcomingProducts(){
        $upcoming_krishi_products = KrishiProduct::where([['available_from','>',Carbon::now()],['status','Active']])->get();
        return view('admin.krishi_baazar.product.upcoming',compact('upcoming_krishi_products'));
    }

    public function show($slug){
        $krishi_product=KrishiProduct::with('itemimage')->where('slug',$slug)->firstOrFail();
        return view('admin.krishi_baazar.product.show',compact('krishi_product'));
    }

    public function approveProduct($id){
        $pending_product=KrishiProduct::findOrFail($id);
        $pending_product->status = 'Active';
        $pending_product->save();
        flash('Product approved successfully');
        return redirect()->action('Admin\KrishiProductController@activeProducts');
    }

    public function rejectProduct($id){
        $pending_product=KrishiProduct::findOrFail($id);
        $pending_product->status = 'Reject';
        $pending_product->save();
        flash('Product rejected successfully');
        return redirect()->action('Admin\KrishiProductController@pendingProducts');
    }

    public function destroy($id){
        KrishiProduct::destroy($id);
        flash('Product deleted successfully');
        return redirect()->action('Admin\KrishiProductController@pendingProducts');
    }
}
