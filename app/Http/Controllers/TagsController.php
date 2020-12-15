<?php

namespace App\Http\Controllers;

use App\Models\ProductTag;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Session;
use Baazar;
class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tag $tag)
    {
      $tag = Tag::all();
      return view('admin.tags.index',compact('tag'));
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
    public function store(Tag $tag,Request $request)
   {
      $this->validateForm($request);
      $slug = Baazar::getUniqueSlug($tag,$request->name);

        $data = Tag::create([
            'name' => $request->name,
            'description' => $request->description,
            'slug' => $slug,
            'user_id' => Auth::user()->id,
            'created_at' => now(),
        ]);

       Session::flash('success', 'Tags Inserted Successfully');

       return redirect('andbaazaradmin/products/tag');

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
    public function edit(Tag $tag)
    {
      return view('admin.tags.edit',compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Tag $tag, Request $request)
    {
        $this->validateForm($request);
          $data = [
              'name' => $request->name,
              'description' => $request->description,
              'user_id' => Auth::user()->id,
              'created_at' => now(),
          ];

          $tag->update($data);
         Session::flash('warning', 'Tags Updated Successfully');
         return redirect('andbaazaradmin/products/tag');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {

          $tag->delete();
          Session::flash('error', 'Tags Deleted Successfully');
          return redirect('andbaazaradmin/products/tag');
    }

    private function validateForm($request){
        $validatedData = $request->validate([
            'name' => 'required',
        ]);
    }
}
