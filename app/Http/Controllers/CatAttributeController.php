<?php

namespace App\Http\Controllers;
use App\Models\Attribute;
use Illuminate\Support\Facades\Auth;
use Session;
use Baazar;
use App\Models\Category;
use Illuminate\Http\Request;

class CatAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categories.attribute');

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
    public function edit($id)
    {
        $categoryid = Category::find($id);
        $categories = Category::with('allChilds')->where('parent_id',0)->where('id',$categoryid)->get();
        $category = Category::where('id',$categoryid)->get();
       return view('admin.categories.attribute',compact('categories','category'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function attribute($slug)
    {
        $categories = Category::with('allChilds')->where('parent_id',0)->get();
        $category = Category::where('slug', $slug)->get();
        return view('admin.categories.attribute',compact('category','categories'));
    }

    public function attributeset(Request $request,Attribute $attribute)
    {
        // // $this->validateForm($request);
        // $data = ([
        //     'label'            => $request->label,
        //     'suggestion'       => $request->suggestion,
        //     'type'             => $request->type,
        //     'required'         => $request->required,
        //     // 'required'         => $request->required[0] ? 0: 1,
        //     'category_id'      => $request->category_id,
//             'user_id'          => Auth::user()->id,
        //     'created_at' => now(),
        //     ]);
        //     Attribute::create($data);
        //     Session::flash('success', 'Attribute Inserted Successfully');

        //     return redirect()->back();
    // }
    $att = count($_POST['label']);
    // $invColor = count($_POST['color_id']);
    // $data[$parts[0]] = isset($parts[1]) ? $parts[1] : null;
    for ( $k = 0; $k<$att; $k++ ){
        Attribute::create([
            'label'          => $request->label[$k],
            'suggestion'     => $request->suggestion[$k],
            'label'          => $request->label[$k],
            'required'       => $request->required[$k],
            'category_id'    => $request->category_id,
            'user_id'        => Auth::user()->id,
            'created_at' => now(),
        ]);
     }
     Session::flash('success', 'Attribute Inserted Successfully');

       return redirect()->back();

 }
    // foreach ($request->approver as $approver) {
    //     $approve              = new Approve();
    //     $approve->approver_id = $approver;
    //     $approve->save();

    //     $document->sentToApprovers()->sync([$approve->id],false);
    // }
}
