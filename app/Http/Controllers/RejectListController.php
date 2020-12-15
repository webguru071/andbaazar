<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reject;
use Illuminate\Support\Facades\Auth;
use Session;
use Baazar;
class RejectListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reject = Reject::all();
        return view('admin.reject_list.index',compact('reject'));
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
    public function store(Reject $reject, Request $request)
    {
        // dd($request->all());
        $this->validateForm($request);
          $data = [
              'rej_name'    => $request->rej_name,
              'type'        => $request->type,
              'user_id'     => Auth::user()->id,
              'created_at'  => now(),
          ];
          Reject::create($data);
          Session::flash('success', 'Reject Inserted Successfully!');
          return redirect('andbaazaradmin/reject');
    }

    public function other(Reject $reject, Request $request)
    {
        // dd($request->all());
        $this->validateForm($request);
          $data = [
              'rej_name'    => $request->rej_name,
              'type'        => $request->type,
              'user_id'     => Auth::user()->id,
              'created_at'  => now(),
          ];
         $reject = Reject::create($data);

          echo json_encode($reject);
        //   Session::flash('success', 'Reject Inserted Successfully!');
        //   return redirect('andbaazaradmin/reject');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Reject $reject, Request $request)
    {
        $this->validateForm($request);
        $data = [
            'rej_name' => $request->rej_name,
            'user_id'     => Auth::user()->id,
            'updated'     => now(),
        ];
             $reject->update($data);
             Session::flash('warning', 'Reject List Updated Successfully!');
             return redirect('andbaazaradmin/reject');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reject $reject)
    {
        $reject->delete();
        Session::flash('error', 'Reject List Deleted Successfully!');
        return redirect('andbaazaradmin/reject');
    }

    private function validateForm($request){
        $validatedData = $request->validate([
            'rej_name' => 'required',
        ]);
 }
}
