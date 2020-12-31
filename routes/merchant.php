<?php


Route::get('sell-on-andbaazar','MerchantController@sellOnAndbaazar');
Route::post('sell-on-andbaazar','MerchantController@sellOnAndbaazarPost')->name('sellOnAndbaazarPost');

//Registration
Route::group(['prefix' => 'merchant'],function () {
    Route::get('otp-varification','MerchantController@getToken')->name('getToken');
    Route::post('otp-varification','MerchantController@postToken')->name('postToken');
    Route::post('token/update','MerchantController@updateToken')->name('updateToken');
    Route::get('personal-info','MerchantController@personalInfo');
    Route::post('personal-info','MerchantController@savePersonalInfo')->name('savePersonalInfo');
    Route::get('shop-info','MerchantController@shopRegistration');
    Route::post('shop-info','MerchantController@shopRegistrationStore')->name('sellerShopeRegistration');
    Route::get('business-info','MerchantController@businessRegistration');
    Route::post('business-info','MerchantController@businessRegistrationStore')->name('businessShopRegistration');
    Route::get('terms-condition','MerchantController@termsCondtion');
    //Login
    Route::get('login','MerchantController@merchantlogin');
    Route::post('login','MerchantController@merchantloginprocess')->name('merchantloginprocess');
    // forgot password route....
    Route::get('forgot_password', 'ForgotPassword@forgot');
    Route::post('forgot_password', 'ForgotPassword@password');
    Route::get('reset_password/', 'ResetPasswordController@reset');
    Route::put('reset_password/{email}', 'ResetPasswordController@updatePassword');
});

Route::group(['prefix' => 'merchant','middleware' => ['auth','merchant','defaultService']],function () {
    Route::get('dashboard','MerchantController@dashboard');

    Route::post('approvement/{id}','MerchantController@approvement');
    Route::post('profiledelete/{id}','MerchantController@profileDelete');
    Route::put('rejected/{id}','MerchantController@rejected');

    Route::put('update/{slug}','MerchantController@update');
    Route::put('resubmit/{id}','MerchantController@statusUpdate');

    Route::get('profile','MerchantController@create');
    Route::post('profile','MerchantController@store')->name('sellerUpdate');
    Route::get('shop','ShopsController@create');
    Route::get('shops/update/{slug}','ShopsController@edit');
    Route::post('shop','ShopsController@update')->name('shopUpdate');

    // Route::get('shop','ShopsController@sort')->name('shortData');
    // Route::get('merchant/{slug}/resubmit','MerchantController@edit');



    Route::get('dropzone', 'DropzoneController@ProductsController');
    Route::post('dropzone/store', 'DropzoneController@ProductsController')->name('dropzone.store');



    // E-commerce Products Are Start//
    Route::group(['prefix' => 'e-commerce', 'middleware' => ['isEcommerceService']],function(){
        Route::Post('products/get-brand/','ProductsController@getBrand');
        Route::get('products/subCategoryChild/{id}','ProductsController@subCategoryChild');
        Route::post('products/approvement/{slug}','ProductsController@approvement');
        Route::put('products/rejected/{slug}','ProductsController@rejected');


        Route::get('products','ProductsController@index')->middleware('isMerchantActive');
        Route::get('products/new','ProductsController@create')->middleware('isMerchantActive');
        Route::post('products/new','ProductsController@store')->name('product.store')->middleware('isMerchantActive');
        Route::get('products/update/{slug}/productupdate','ProductsController@edit');
        Route::put('products/update/{slug}','ProductsController@update');
        Route::post('products/single-inventory-delete','ProductsController@deleteInventory');
        Route::get('products','ProductsController@clear');
        Route::resource('products','ProductsController');

        Route::get('inventories/new','InventoriesController@create');
        Route::post('inventories/new','InventoriesController@store')->name('inventory.store');
        Route::get('inventories/update/{slug}/invertoryupdate','InventoriesController@edit');
        Route::put('inventories/update/{slug}','InventoriesController@update');
        Route::resource('inventories','InventoriesController');
    });
    // Sme Products Are Start//
    Route::group(['prefix' => 'sme','middleware' => ['isSmeService']],function(){
        Route::get('products','SmeProductController@index')->middleware('isMerchantActive');
        Route::get('products/new','SmeProductController@create')->middleware('isMerchantActive');
        Route::post('products/new','SmeProductController@store')->name('smeproduct.store')->middleware('isMerchantActive');;
        Route::get('products/view/{slug}','SmeProductController@show')->middleware('isMerchantActive');
        Route::get('products/update/{slug}/','SmeProductController@edit');
        Route::put('products/update/{slug}','SmeProductController@update');
        Route::post('products/single-inventory-delete','SmeProductController@deleteInventory');
        Route::get('product','SmeProductController@clear');
        Route::resource('product','SmeProductController');

        Route::get('inventories/new','SmeInventoryController@create');
        Route::post('inventories/new','SmeInventoryController@store')->name('smeinventory.store');
        Route::get('inventories/update/{slug}/smeinventroyupdate','SmeInventoryController@edit');
        Route::put('inventories/update/{slug}','SmeInventoryController@update');
        Route::resource('inventories','SmeInventoryController');

    });

    // Auction Product Start //

     Route::group(['prefix' => 'auction','middleware' => ['isAuctionService']],function(){
        Route::get('category/{type}','AuctionproductController@categoryid');
        Route::get('products/new','AuctionproductController@create');
        Route::post('products/new','AuctionproductController@store')->name('auctionstore');
        Route::get('products/update/{slug}/auctionupdate','AuctionproductController@edit');
        Route::put('products/update/{slug}','AuctionproductController@update');
        Route::post('products/approvement/{slug}','AuctionproductController@approvemetnt');
        Route::put('products/rejected/{slug}','AuctionproductController@rejected');
        Route::resource('products','AuctionproductController');
        // Route::get('products','AuctionproductController@index');
        // Route::get('add','AuctionproductController@create');
        // Route::post('add','AuctionproductController@store');
    });

    // Auction Product End //

    //    Krishi Baazar Start   //
      Route::group(['prefix' => 'krishi','middleware' => ['isKrishiService']],function(){
        // Route::resource('category','KrishiProductCategoryController');
        Route::get('products/new','KrishiProductController@create');
        Route::post('products/new','KrishiProductController@store')->name('krishiproductstore');
        Route::get('products/update/{slug}/krishiupdate','KrishiProductController@edit');
        Route::put('products/updat/{slug}','KrishiProductController@update');
        Route::post('products/approvement/{slug}','KrishiProductController@approvemetnt');
        Route::put('products/rejected/{slug}','KrishiProductController@rejected');
        Route::resource('products','KrishiProductController');
        Route::get('products/subCategoryChild/{id}','KrishiProductController@subCategoryChild');
        Route::post('products/review-replay-merchant','KrishiProductController@replayReview');

      });
      //    Krishi Baazar End    //





    Route::get('inventories/inventoryAttrioption/{id}','InventoriesController@inventoryAttrioption');
    Route::get('inventories/inventorycolor','InventoriesController@inventoryColor');
    Route::get('inventories/inventory/{id}','AjaxController@searchColorWiseInventory');


    Route::post('get-inventory-attr','InventoryAttributeController@getInventoryAttr');
    Route::post('get-inventory-attr-new-Inventory','InventoryAttributeController@getInventoryAttrOnNewInventory');
    Route::post('get-category-attr','CategoriesController@getCategoryAttr');

    Route::group(['prefix' => 'newsfeed'], function () {
        Route::get('new','NewsfeedController@create');
        Route::post('new','NewsfeedController@store')->name('NewsFeed');
        Route::get('update/{slug}/newsfeedupdate','NewsfeedController@edit');
        Route::put('update/{slug}','NewsfeedController@update');
        Route::post('approvement/{slug}','NewsfeedController@approvement');
        Route::put('reject/{slug}','NewsfeedController@reject');
        Route::post('comment-replay-merchant','NewsfeedController@commentReply');
        Route::resource('news','NewsfeedController');
    });


    Route::post('shop-logo-crop', 'MerchantController@shopLogoCrop')->name('shop-logo-crop');
    Route::post('shop-banar-crop', 'MerchantController@shopBanarCrop')->name('shop-banar-crop');
    Route::post('profile-image-crop', 'MerchantController@profileImageCrop')->name('profile-image-crop');

    //ajax division-district-upazila-union filter

});
Route::post('get-district', 'AjaxController@getDistrict')->name('get-district');
Route::post('get-upazila', 'AjaxController@getUpazila')->name('get-upazila');
Route::post('get-union', 'AjaxController@getUnion')->name('get-union');
Route::post('get-village', 'AjaxController@getVillage')->name('get-village');
Route::post('get-ward', 'AjaxController@getWard')->name('get-ward');




