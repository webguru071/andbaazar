<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KrishiCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Baazar;

class KrishiProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $krishi_categories = KrishiCategory::with('parent')->get();
        return view('admin.krishi_baazar.category.index',compact('krishi_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = KrishiCategory::with('childs')->where([['parent_id',0],['active',1]])->get();
        return view('admin.krishi_baazar.category.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'bail|required',
            'parent_id' => 'bail|required|integer|exists:krishi_product_categories,id',
            'icon' => 'bail|required',
            'thumbnail_image' => 'required|file',
            'active' => 'required|integer|min:0|max:1',
        ]);
        if ($validator->fails()) {
            flash($validator->errors()->first())->error();
            return redirect()->back()->withInput();
        }
        $parent_category=KrishiCategory::findOrFail($request->parent_id);
        $parent_category->is_last=0;
        $parent_category->save();
        $allData = $request->all();
        $allData['parent_slug']=$parent_category->slug;
        $allData['slug']= Baazar::getUniqueSlug($parent_category,$parent_category->slug);
        $allData['is_last']= 1;
        $allData['user_id']= Auth::id();

        if ($request->hasFile('thumbnail_image')){
            $path=$request->file('thumbnail_image')->store('images');
            $image = Image::make(Storage::get($path))->fit(450, 170)->encode();
            Storage::put($path, $image);
            $allData['thumbnail_image']=$path;
        }
        KrishiCategory::create($allData);
        flash('New category added successfully');
        return redirect()->action('Admin\KrishiProductCategoryController@index');
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
    public function edit($id)
    {
        $krishi_category=KrishiCategory::with('parent')->where('id',$id)->firstOrFail();
        $categories = KrishiCategory::with('childs')->where([['parent_id',0],['active',1]])->get();
        return view('admin.krishi_baazar.category.edit',compact('krishi_category','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'bail|required',
            'parent_id' => 'bail|required|integer|exists:krishi_product_categories,id',
            'icon' => 'bail|required',
            'active' => 'required|integer|min:0|max:1',
        ]);
        if ($validator->fails()) {
            flash($validator->errors()->first())->error();
            return redirect()->back()->withInput();
        }
        $krishiCategpory= KrishiCategory::findOrFail($id);
        $prev_parent_category=KrishiCategory::with('childs')->findOrFail($krishiCategpory->parent_id);
        if (count($prev_parent_category->childs)<=1){
            $prev_parent_category->is_last=1;
            $prev_parent_category->save();
        }
        $parent_category=KrishiCategory::findOrFail($request->parent_id);
        $parent_category->is_last=0;
        $parent_category->save();

        $krishiCategpory->name = $request->name;
        $krishiCategpory->parent_slug = $parent_category->slug;
        $krishiCategpory->parent_id = $request->parent_id;
        $krishiCategpory->icon = $request->icon;
        $krishiCategpory->description = $request->description;
        $krishiCategpory->active = $request->active;
        $krishiCategpory->user_id = Auth::id();

        if ($request->hasFile('thumbnail_image')){
            $path=$request->file('thumbnail_image')->store('images');
            $image = Image::make(Storage::get($path))->fit(450, 170)->encode();
            Storage::put($path, $image);
            Storage::delete($krishiCategpory->thumbnail_image);
            $krishiCategpory->thumbnail_image=$path;
        }

        $krishiCategpory->save();
        flash('Category updated successfully');
        return redirect()->action('Admin\KrishiProductCategoryController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        KrishiCategory::destroy($id);
        flash('Category deleted successfully')->success();
        return redirect()->action('Admin\KrishiProductCategoryController@index');
    }
}
