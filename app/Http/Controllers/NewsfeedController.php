<?php

namespace App\Http\Controllers;

use App\Models\Newsfeed;
use Illuminate\Http\Request;
use App\Models\Product;
use App\User;
use Illuminate\Support\Facades\Auth;
use Session;
use Baazar;
use App\Models\Reject;
use App\Models\RejectValue;
use DB;

class NewsfeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newsFeed = Newsfeed::where('user_id',Auth::user()->id)->where('title','!=','')->paginate(10);
        $rejectReason = RejectValue::where('user_id',Auth::user()->id)->where('type','feed')->get();
        // dd($rejectReason);


        return view('merchant.newsFeed.index',compact('newsFeed','rejectReason'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('merchant.newsFeed.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Newsfeed $newsfeed)
    {
        $this->validateForm($request);
        $slug = Baazar::getUniqueSlug($newsfeed,$request->title);
        $data = [
            'title'      => $request->title,
            'slug'       => $slug,
            'image'      => Baazar::fileUpload($request,'image','','/uploads/newsfeed_image'),
            'news_desc'  => $request->news_desc,
            'user_id'    => Auth::user()->id,
            'created_at' => now(),
        ];

        Newsfeed::create($data);

        Session::flash('success','News feed Added successfully');

        return redirect('merchant/newsfeed/news');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Newsfeed  $newsfeed
     * @return \Illuminate\Http\Response
     */
    public function show(Newsfeed $newsfeed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Newsfeed  $newsfeed
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $newsFeed = Newsfeed::where('slug',$slug)->first();

        return view('merchant.newsFeed.edit',compact('newsFeed'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Newsfeed  $newsfeed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $newsFeed = Newsfeed::where('slug',$slug)->first();

        $data = [
            'title'      => $request->title,
            'image'      => Baazar::fileUpload($request,'image','old_image','/uploads/newsfeed_image'),
            'news_desc'  => $request->news_desc,
            'updated_at' => now(),
        ];

        $newsFeed->update($data);

        Session::flash('success','News feed update successfully');

        return redirect('merchant/newsfeed/news');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Newsfeed  $newsfeed
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newsFeed = Newsfeed::find($id);
        $newsFeed->delete();

        Session::flash('error','News feed delete successfully');

        return redirect('merchant/newsfeed/news');
    }

    public function feedlist()
    {
        $rejectlist = Reject::where('type','feed')->get();

        $newsFeed = Newsfeed::where('title','!=','')->get();

        return view('merchant.newsFeed.newsfeed_list',compact('newsFeed','rejectlist'));
    }

    public function approvement($slug){
        $data =  Newsfeed::where('slug',$slug)->first();

        $data->update(['status'=>'Active']);



        Session::flash('success','News feed Approve successfully.');

        return back();
    }

    public function reject(Request $request,$slug){
        $data =  Newsfeed::where('slug',$slug)->first();

        $data->update([
            'status'=>'Reject'
            ]);

            $rejct_value = RejectValue::where('id', $data->id)->first();

            $rej_list = count($_POST['rej_name']);

            for($i = 0; $i<$rej_list; $i++){
                    $rejct_value=RejectValue::create([
                    'rej_name'      => $request->rej_name[$i],
                    'type'          => $request->type,
                    'merchant_id'   => $data->id,
                    'user_id'       => $data->user_id,
                ]);
                // dd($data);
            }

        Session::flash('error','News feed Reject successfully.');

        return back();
    }

    private function validateForm($request){
        $validatedData = $request->validate([
            'title'     => 'required',
            'news_desc' => 'required'
        ]);
    }
}
