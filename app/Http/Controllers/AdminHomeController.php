<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Merchant;
use App\Models\Product;
class AdminHomeController extends Controller{

    public function dashboard(){
        if (Auth::check()){
            $newMerchant = Merchant::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count('first_name');
            $newProduct = Product::whereMonth('created_at',date('m'))
            ->whereYear('created_at',date('Y'))
            ->count('name');

            return view('admin.dashboard',compact('newMerchant','newProduct'));
        }else{
            return redirect('andbaazar/login')->with('error','Invalid email or password');
        }

    }

}
