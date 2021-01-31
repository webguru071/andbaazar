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
        Route::post('/profile-update','UserController@userProfileUpdate');
        Route::post('/reset-password','UserController@resetPassword');
        Route::post('/change-password','UserController@changePassword');
        Route::get('/logout','UserController@logout');

        //Address
        Route::get('address-book','Customer\CustomerAddressController@index');
        Route::delete('delete-address/{id}','Customer\CustomerAddressController@delete');
        Route::post('create-address','Customer\CustomerAddressController@createAddress');
        Route::put('update-address/{id}','Customer\CustomerAddressController@updateAddress');

        //get Geo Address
        Route::get('divisions','GeoController@getDivisions');
        Route::get('districts','GeoController@getDistricts');
        Route::get('upazilas','GeoController@getUpazilas');
        Route::get('unions','GeoController@getUnions');
        Route::get('villages','GeoController@getVillages');
        Route::get('municipals','GeoController@getMunicipals');
        Route::get('municipal-wards','GeoController@getMunicipalsWards');
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
            Route::get('/sub-categories/{parent_slug}','SiteInfoController@getSubCategories');
            Route::get('/parent-categories/{slug}','SiteInfoController@getParentCategories');
            Route::get('/search','SiteInfoController@search');
            Route::get('/shops','SiteInfoController@shops');
            Route::get('/shop-products/{slug}','SiteInfoController@shopProducts');
        });

        //     For product info
        Route::get('/product-details/{slug}','KrishiProductController@product_details');
        Route::get('/product-reviews/{slug}','KrishiProductController@product_reviews');
        Route::get('/related-products/{slug}','KrishiProductController@related_products');

    });
});
