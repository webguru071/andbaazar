<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
route::get('some-expriment',function(){
    // is_dir("/home/andbaazar/domains/andbaazar.com/public_html/app");
    $d = symlink('/home/andbaazar/domains/andbaazar.com/app/storage/app/public','/home/andbaazar/domains/andbaazar.com/public_html/app/storage');
    dd($d);
    // echo storage_path('app/public')."<br>";
    // echo public_path('../');
    // die(351);
    // $storage = is_dir("/home/andbaazar/domains/andbaazar.com/app/storage/app/public");
    // $public = is_dir("/home/andbaazar/domains/andbaazar.com");
    // // dd($public);
    // if(!file_exists($storage)) {
    //     $dd = \App::make('files')->link($storage, $public);
    //     dd($dd);
    // }else{
    //     echo 'dfs';
    // }
    // symlink('/home/andbaazar/app.andbaazar.com/storage/app/public','/home/andbaazar/public_html/app/storage');
    // shell_exec('php ../artisan passport:install');
    // Artisan::call('passport:install');
    // return response()->json(['amer'=>'ki','ta'=>'jani na']);
});
Route::get('/', 'MerchantController@sellOnAndbaazar');
Route::get('/login', 'AuthController@userLogin')->name('login');
Route::post('/user-auth', 'AuthController@userAuth');
Route::get('/profile','AuthController@userProfile')->middleware('auth');
Route::get('/select-service','AuthController@selectDefaultService')->middleware('auth');
Route::post('/select-service','AuthController@setDefaultService')->middleware('auth');
Route::get('/business-info','AuthController@selectBusinessInfo')->middleware('auth');
Route::post('/business-info','AuthController@updateBusinessInfo')->middleware('auth');
Route::get('/change-business-info','UserController@changeBusinessInfo')->middleware('auth');
Route::post('/change-business-info','UserController@updateBusinessInfo')->middleware('auth');
Route::get('/logout','AuthController@logout');
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.verify');
// include('frontend.php');
include('merchant.php');
include('agent.php');
include('admin.php');





