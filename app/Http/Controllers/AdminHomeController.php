<?php

namespace App\Http\Controllers;

use App\Models\MerchantProfile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class AdminHomeController extends Controller{

    public function dashboard(){
        if (Auth::check()){
            $newMerchant = User::where([['type','merchant'],['status',1]])->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();
            $newProduct = Product::whereMonth('created_at',date('m'))
            ->whereYear('created_at',date('Y'))
            ->count('name');

            return view('admin.dashboard',compact('newMerchant','newProduct'));
        }else{
            return redirect('andbaazar/login')->with('error','Invalid email or password');
        }

    }

}
