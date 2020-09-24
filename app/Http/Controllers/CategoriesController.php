<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ProductCategory;
use App\Models\Children;
use Sentinel;
use Session;
use Baazar;
class CategoriesController extends Controller
{
    public function getData(){
        $cats = Category::where('parent_id',0)->get();
        return response()->json($cats);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('allChilds')->where('parent_id',0)->get();
        $category = Category::where('parent_id',0)->get();
        $subcategories = Category::all();
        return view('admin.categories.index',compact('category','categories','subcategories'));
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


    public function store(Request $request, Category $category)
    {
        $this->validateForm($request);
        $slug = Baazar::getUniqueSlug($category,$request->name);
        $data = Category::create([
            'name'             => $request->name,
            'desc'             => $request->desc,
            'slug'             => $slug,
            'type'             => $request->type,
            // 'parent_slug'      => $parent_slug,
            'thumb'            => Baazar::fileUpload($request,'thumb','','/uploads/category_image'),
            'percentage'       => $request->percentage,
            'sort'             => $request->sort,
            'user_id'          => Sentinel::getUser()->id,
            'created_at' => now(),
            ]);


            Session::flash('success', 'Category Inserted Successfully');

            return redirect('andbaazaradmin/products/category');
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
    public function edit(Category $category)
    {
        return view('admin.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $this->validateForm($request);
        $data =[
            'name'       => $request->name,
            'desc'       => $request->desc,
            'thumb'      => Baazar::fileUpload($request,'thumb','old_image','/uploads/category_image'),
            'percentage' => $request->percentage,
            'sort'       => $request->sort,
            'user_id'    => Sentinel::getUser()->id,
            'updated_at' => now(),
        ];

        $category->update($data);

        Session::flash('warning', 'Category Updated Successfully');
        return redirect('andbaazaradmin/products/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

       Session::flash('error', 'Category Deleted Successfully');

        return redirect('andbaazaradmin/products/category');
    }

    public function manageCategory()
    {
        $categoriesEcommerce = Category::with('allChilds')->where('parent_id',0)->where('type','ecommerce')->get();
        $categoriesSme       = Category::with('allChilds')->where('parent_id',0)->where('type','sme')->get();
        $categoriesKrishi    = Category::with('allChilds')->where('parent_id',0)->where('type','krishi')->get();
        // dd($categoriesSme);
        // dd($categories);
        return view ('admin.categories.tree',compact('categoriesEcommerce','categoriesSme','categoriesKrishi'));
        // $categories = Category::where('parent_id',0)->get();
        // $subcategories = Children::all();
        // $allCategories = Category::pluck('name','id')->all();
        // return view('admin.categories.categoryTreeview',compact('categories','allCategories','subcategories'));
    }

    public function manageSubCategory()
    {
        $categories = Category::with('allChilds')->where('parent_id',0)->get();
        // dd($categories);
        // return view ('admin.categories.tree',compact('categories'));
        $categories = Category::where('parent_id',0)->get();
        $subcategories = Category::all();
        $allCategories = Category::pluck('name','id')->all();
        return view('admin.categories.categoryTreeview',compact('categories','allCategories','subcategories'));
    }

    public function addCategory(Request $request,Category $category)
    {
        //  dd($request->all());
        $slug = Baazar::getUniqueSlug($category,$request->name);
        $input = $request->all();
        $parent_slug = Category::find($request->parent_id);
        $input['parent_id']      = empty($input['parent_id']) ? 0 : $input['parent_id'];
        $input['slug']           = $slug;
        $input['percentage']     = $request->percentage;
        $input['desc']           = $request->desc;
        $input['thumb']          = Baazar::fileUpload($request,'thumb','','/uploads/category_image');
        $input['parent_slug']    = $parent_slug->slug;
        $input['user_id']        = Sentinel::getUser()->id;
        $input['is_last']        = 1;
        Category::create($input);
        $parent_slug->is_last = 0;
        $parent_slug->save();
        return back()->with('success', 'New Category added successfully.');
    }

    private function validateForm($request){
        $validatedData = $request->validate([
            'name'       => 'required',
            'percentage' => 'required'
        ]);
    }

    public function getCategoryAttr(Request $request){
        $attributes = Category::find($request->cat_id);
        $attributesHTML = '';
        $i = 2;
        foreach($attributes->categoryAttr as $att){
            if($i == 4){
                $attributesHTML .= "<div class='less'>";
            }
            if($i%2 == 0){
                $attributesHTML .= "<div class='from-group row line-40'>";
            }
            $attributesHTML .= "<label for='' class='col-sm-3 text-right'>{$att->label}</label>";
            switch($att->type){
                case "select":
                    $attributesHTML .= "<select name='attribute[{$att->id}]' class='col-sm-3 form-control' id=''>";
                        foreach($att->options as $opt){
                            $attributesHTML .= "<option value='{$opt->values}'>{$opt->values}</option>";
                        }
                        $attributesHTML .= "</select>";
                break;

                default:
                    $attributesHTML .= "<input name='attribute[{$att->id}]' type='text' class='col-sm-3 form-control'>";
            }
            if($i%2 == 1){
                $attributesHTML .= "</div>";
            }
            $i++;

        }
        $attributesHTML .= "</div>";
        echo json_encode(['attributes' => $attributesHTML, 'status' => 'OK']);
    }
}
