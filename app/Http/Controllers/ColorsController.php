<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;
use Illuminate\Support\Facades\Auth;
use Session;
use Baazar;
class ColorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $color = Color::all();
      return view('admin.colors.index',compact('color'));
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
    public function store(Color $color,Request $request)
    {
      $this->validateForm($request);
      $slug = Baazar::getUniqueSlug($color,$request->name);
        $data = [
            'name' => $request->name,
            'slug' => $slug,
            'color_code' => $request->color_code,
            'user_id' => Auth::user()->id,
            'created_at' => now(),
        ];
        Color::create($data);
        Session::flash('success', 'Colors Inserted Successfully!');
        return redirect('andbaazaradmin/products/color');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color)
    {
      return view('admin.colors.edit',compact('color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Color $color, Request $request)
    {
      $this->validateForm($request);
      $data = [
          'name' => $request->name,
          'color_code' => $request->color_code,
          'user_id' => Auth::user()->id,
          'created_at' => now(),
      ];
           $color->update($data);
           Session::flash('warning', 'Colors Updated Successfully!');
           return redirect('andbaazaradmin/products/color');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
      $color->delete();
      Session::flash('error', 'Colors Deleted Successfully!');
      return redirect('andbaazaradmin/products/color');
    }

    private function validateForm($request){
        $validatedData = $request->validate([
            'name' => 'required',
            'color_code' => 'required',
            'slug'=>'',
        ]);
    }
}
