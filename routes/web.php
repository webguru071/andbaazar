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
route::get('check',function(){
    return response()->json(['amer'=>'ki','ta'=>'jani na']);
});
Route::get('/', 'MerchantController@sellOnAndbaazar');
Route::get('/login', 'AuthController@userLogin');
Route::post('/user-auth', 'AuthController@userAuth');
Route::get('/profile','AuthController@userProfile')->middleware('auth');
Route::get('/select-service','AuthController@selectDefaultService')->middleware('auth');
Route::post('/select-service','AuthController@setDefaultService')->middleware('auth');
Route::get('/business-info','AuthController@selectBusinessInfo')->middleware('auth');
Route::post('/business-info','AuthController@updateBusinessInfo')->middleware('auth');
Route::get('/change-business-info','UserController@changeBusinessInfo')->middleware('auth');
Route::post('/change-business-info','UserController@updateBusinessInfo')->middleware('auth');
Route::get('/logout','AuthController@logout');
// include('frontend.php');
include('merchant.php');
include('agent.php');
include('admin.php');





