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

Route::group(['prefix'=>'v-1','namespace'=>'Api'],function (){
    Route::post('/registration','UserController@registration');
    Route::post('/login','UserController@login');
    Route::post('/forget-password','UserController@forgetPassword');
    Route::post('/user-verify-otp','UserController@sendVerifyOTP');
    Route::post('/user-verify-email-link','UserController@sendEmailVerificationLink');
    Route::post('/verify-otp','UserController@verifyOTP');

    Route::group(['middleware'=>['auth:api','isActive']],function (){
        //   For User Authentication
        Route::get('/profile','UserController@profile');
        Route::post('/reset-password','UserController@resetPassword');
        Route::get('/logout','UserController@logout');
    });

    Route::group(['middleware'=>['auth:api']],function (){
        //   For User Authentication

    });

    Route::group(['prefix'=>'krishibazar'],function (){
        Route::group(['prefix'=>'site-info'],function (){
            //   For Website Info
            Route::get('/product-categories','SiteInfoController@productCategories');
            Route::get('/slider-list','SiteInfoController@sliderList');
            Route::get('/rising-star-shops','SiteInfoController@risingStarShops');
            Route::get('/flash-deal-products','SiteInfoController@flashDealProducts');
            Route::get('/best-seller-products','SiteInfoController@bestSellerProducts');
            Route::get('/popular-categories','SiteInfoController@popularCategories');
            Route::get('/new-arrival-products','SiteInfoController@newArrivalProducts');
            Route::get('/upcoming-products','SiteInfoController@upcomingProducts');
            Route::get('/top-rated-products','SiteInfoController@topRatedProducts');
            Route::get('/category-wise-products/{parent_category}','SiteInfoController@CategoryWiseProducts');
            Route::get('/sub-categories/{parent_category}','SiteInfoController@getSubCategories');
            Route::get('/search','SiteInfoController@search');
        });

        //     For product info
        Route::get('/product-details','KrishiProductController@product_details');
        Route::get('/related-products','KrishiProductController@related_products');

    });
});
