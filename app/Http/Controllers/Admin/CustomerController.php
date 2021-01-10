<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function active_customers(){
        $active_customers = User::with('customerDetails')->where([['type','customer'],['status',1]])->get();
        return view('admin.customer.active_customers',compact('active_customers'));
    }

    public function pending_customers(){
        $pending_customers = User::with('customerDetails')->where([['type','customer'],['status',0]])->get();
        return view('admin.customer.pending_customers',compact('pending_customers'));
    }

    public function rejected_customers(){
        $rejected_customers = User::with('customerDetails')->where([['type','customer'],['status',2]])->get();
        return view('admin.customer.rejected_customers',compact('rejected_customers'));
    }

    public function approve_customer(Request $request, $id){
        $user = User::findOrFail($id);
        $user->status = 1;
        $user->save();
        flash('Customer approved successfully');
        return redirect('andbaazaradmin/customers/pending');

    }

    public function reject_customer(Request $request, $id){
        $user = User::findOrFail($id);
        $user->status = 2;
        $user->save();
        flash('Customer rejected successfully');
        return redirect('andbaazaradmin/customers/pending');
    }

    public function destroy($id)
    {
        User::destroy($id);
        flash('Customer deleted successfully');
        return redirect('andbaazaradmin/customers/pending');
    }
}
