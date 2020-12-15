<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PromotionHead;
use Illuminate\Support\Facades\Auth;
use Session;
use Baazar;
class PromotionHeadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $promotionhead= PromotionHead::all();
      return view('admin.promotionhead.index',compact('promotionhead'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PromotionHead $promotionhead,Request $request)
    {
      $this->validateForm($request);
      $slug = Baazar::getUniqueSlug($promotionhead,$request->promotion_name);
        $data = [
            'promotion_name' => $request->promotion_name,
            'description'    => $request->description,
            'slug'           => $slug,
            'user_id'        => Auth::user()->id,
            'created_at'     => now(),
        ];

        PromotionHead::create($data);



        Session::flash('success', 'Promotion Heads Added  Successfully!');
        return redirect('andbaazaradmin/promotionhead');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PromotionHead $promotionhead)
    {
      //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PromotionHead $promotionhead)
    {
      //dd($promotionhead);
      return view('admin.promotionhead.edit',compact('promotionhead'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PromotionHead $promotionhead, Request $request)
    {
      $this->validateForm($request);
        $data = [
            'promotion_name' => $request->promotion_name,
            'description'    => $request->description,
            'user_id'        => Auth::user()->id,
            'updated_at'     => now(),
        ];

      $promotionhead->update($data);


     Session::flash('warning', 'Promotion Heads Updated  Successfully!');

      return redirect('andbaazaradmin/promotionhead');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PromotionHead $promotionhead)
    {
          $promotionhead->delete();

        Session::flash('error', 'Promotion Heads Deleted  Successfully!');
          return redirect('andbaazaradmin/promotionhead');
    }

    private function validateForm($request){
        $validatedData = $request->validate([
            'promotion_name' => 'required',
            'description'    => 'required'
        ]);
    }
}
