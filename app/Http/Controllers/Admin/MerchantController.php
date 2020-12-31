<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    public function active_merchants(){
        $active_merchants = User::with('merchantDetails')->where([['type','merchant'],['status',1]])->get();
        return view('admin.merchant.active_merchants',compact('active_merchants'));
    }

    public function pending_merchants(){
        $pending_merchants = User::with('merchantDetails')->where([['type','merchant'],['status',0]])->get();
        return view('admin.merchant.pending_merchants',compact('pending_merchants'));
    }

    public function rejected_merchants(){
        $rejected_merchants = User::with('merchantDetails')->where([['type','merchant'],['status',2]])->get();
        return view('admin.merchant.rejected_merchants',compact('rejected_merchants'));
    }
}
