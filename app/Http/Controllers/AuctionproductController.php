<?php

namespace App\Http\Controllers;

use App\Auctionproduct;
use Illuminate\Http\Request;
use App\Models\Category;
use Sentinel;
use Session;
use Baazar;

class AuctionproductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auction.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id',0)->get();
        return view('auction.product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Auctionproduct  $auctionproduct
     * @return \Illuminate\Http\Response
     */
    public function show(Auctionproduct $auctionproduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Auctionproduct  $auctionproduct
     * @return \Illuminate\Http\Response
     */
    public function edit(Auctionproduct $auctionproduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Auctionproduct  $auctionproduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Auctionproduct $auctionproduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Auctionproduct  $auctionproduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(Auctionproduct $auctionproduct)
    {
        //
    }
}
