<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//route::get('checks','CategoriesController@getData');
//route::get('product/{slug}','ApiRequestConrtoller@singleProduct');
//route::get('products','ApiRequestConrtoller@products');
//route::get('unique-colors','ApiRequestConrtoller@getColors');
//route::get('unique-size','ApiRequestConrtoller@getSizes');
//Route::post('registration','Api\CustomerApiController@registration');
//Route::post('login','Api\CustomerApiController@login');
//Route::get('me','Api\CustomerApiController@me')->middleware('ApiAuth');
//// Route::post('login','CustomerController@userloginprocess')->name('userloginprocess');
//Route::prefix('customer')->group(function () {
//    Route::get('shipping','Api\CustomerApiController@shipping');
//});



Route::group(['prefix'=>'v-1','namespace'=>'Api'],function (){
    Route::post('/login','UserController@login');
    Route::group(['middleware'=>['auth:api','isActive']],function (){
        //   For User Authentication
        Route::get('/logout','UserController@logout');
        Route::get('/profile','UserController@profile');
    });
});
