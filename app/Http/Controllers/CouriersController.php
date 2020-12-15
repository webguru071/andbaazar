<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courier;
use Illuminate\Support\Facades\Auth;
use Session;
use Baazar;
class CouriersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courier = Courier::all();
        return view('admin.couriers.index',compact('courier'));
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
    public function store(Courier $courier,Request $request)
    {
        $this->validateForm($request);
        $slug = Baazar::getUniqueSlug($courier,$request->name);
        $data = [
            'name' => $request->name,
            'desc' => $request->desc,
            'slug' => $slug,
            'user_id' => Auth::user()->id,
            'created_at' => now(),
        ];

        Courier::create($data);
        Session::flash('success', 'Courier Inserted Successfully!');
        return redirect('andbaazaradmin/courier');
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
    public function edit(Courier $courier)
    {
        return view('admin.couriers.edit',compact('courier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Courier $courier)
    {
        $this->validateForm($request);
        $data = [
            'name' => $request->name,
            'desc' => $request->desc,
            'user_id' => Auth::user()->id,
            'created_at' => now(),
        ];

        $courier->update($data);
        Session::flash('warning', 'Courier Updated Successfully!');
        return redirect('andbaazaradmin/courier');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Courier $courier)
    {
        $courier->delete();
        Session::flash('error', 'Courier Deleted Successfully!');
        return redirect('andbaazaradmin/courier');
    }

    private function validateForm($request){
        $validatedData = $request->validate([
            'name' => 'required',
        ]);
    }
}
