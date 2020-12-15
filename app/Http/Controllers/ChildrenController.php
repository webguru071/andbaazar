<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Children;
use Illuminate\Support\Facades\Auth;
use Session;
use Baazar;

class ChildrenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
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
    public function edit(Children $child)
    {
        return view('admin.categories.childEdit',compact('child'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Children $child)
    {
        $data = [
            'name' => $request->name,
            'user_id' => Auth::user()->id,
            'updated_at' => now(),
        ];

        $child->update($data);

        return redirect('andbaazaradmin/category-tree-view');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Children $child)
    {
        $child->delete();
        return redirect('andbaazaradmin/category-tree-view');
    }
}
