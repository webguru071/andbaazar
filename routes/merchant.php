<?php


Route::get('sell-on-andbaazar','MerchantController@sellOnAndbaazar');
Route::post('sell-on-andbaazar','MerchantController@sellOnAndbaazarPost')->name('sellOnAndbaazarPost');

Route::group(['prefix' => 'merchant'],function () {
    //Registration
    Route::get('otp-varification','MerchantController@getToken')->name('getToken');
    Route::post('otp-varification','MerchantController@postToken')->name('postToken');
    Route::post('token/update','MerchantController@updateToken')->name('updateToken');
    Route::get('personal-info','MerchantController@personalInfo');
    Route::post('personal-info','MerchantController@savePersonalInfo')->name('savePersonalInfo');
    Route::get('shop-info','MerchantController@shopRegistration');
    Route::post('shop-info','MerchantController@shopRegistrationStore')->name('sellerShopeRegistration');
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

Route::group(['prefix' => 'merchant','middleware' => ['auth','merchant']],function () {
    Route::get('dashboard','MerchantController@dashboard');

    Route::post('merchant/approvement/{id}','MerchantController@approvement');
    Route::post('merchant/profiledelete/{id}','MerchantController@profileDelete');
    Route::put('merchant/rejected/{id}','MerchantController@rejected');

    Route::put('merchant/{slug}','MerchantController@update');
    Route::put('merchant/resubmit/{id}','MerchantController@statusUpdate');
    Route::get('merchant/{id}','MerchantController@show');


    
    Route::get('profile','MerchantController@create');
    Route::post('profile','MerchantController@store')->name('sellerUpdate');
    Route::get('shop','ShopsController@create');
    Route::get('shops/update/{slug}','ShopsController@edit');
    Route::post('shop','ShopsController@update')->name('shopUpdate');

    // Route::get('shop','ShopsController@sort')->name('shortData');
    // Route::get('merchant/{slug}/resubmit','MerchantController@edit');



    Route::get('dropzone', 'DropzoneController@ProductsController');
    Route::post('dropzone/store', 'DropzoneController@ProductsController')->name('dropzone.store');

    Route::Post('product/get-brand/','ProductsController@getBrand');
    Route::get('product/subCategoryChild/{id}','ProductsController@subCategoryChild');
    Route::post('product/approvement/{slug}','ProductsController@approvement');
    Route::put('product/rejected/{slug}','ProductsController@rejected');
    Route::get('product/vendorshow/{slug}','ProductsController@vendorshow');

    Route::get('products','ProductsController@index')->middleware('isMerchantActive');
    Route::get('products/new','ProductsController@create')->middleware('isMerchantActive');;
    Route::post('products/new','ProductsController@store')->name('product.store')->middleware('isMerchantActive');;
    Route::get('products/view/{slug}','ProductsController@show')->middleware('isMerchantActive');
    Route::get('products/update/{slug}/productupdate','ProductsController@edit');
    Route::put('products/update/{slug}','ProductsController@update'); 
    Route::post('products/single-inventory-delete','ProductsController@deleteInventory'); 
    Route::get('product','ProductsController@clear'); 
    Route::resource('product','ProductsController');




    // Sme Products Are Start//
    Route::group(['prefix' => 'sme'],function(){
        Route::get('products','SmeProductController@index')->middleware('isMerchantActive');
        Route::get('products/new','SmeProductController@create')->middleware('isMerchantActive');;
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



    Route::get('inventories','InventoriesController@index')->middleware('isMerchantActive');
    Route::get('inventories/view/{slug}','InventoriesController@show');
    Route::get('e-commerce/inventories/new','InventoriesController@create');
    Route::post('e-commerce/inventories/new','InventoriesController@store')->name('inventory.store');
    Route::get('e-commerce/inventories/update/{slug}/invertoryupdate','InventoriesController@edit');
    Route::put('e-commerce/inventories/update/{slug}','InventoriesController@update');
    Route::get('inventories/inventoryAttrioption/{id}','InventoriesController@inventoryAttrioption');
    Route::get('inventories/inventorycolor','InventoriesController@inventoryColor');
    Route::get('inventories/inventory/{id}','AjaxController@searchColorWiseInventory');
    Route::resource('e-commerce/inventories','InventoriesController');

    Route::post('get-inventory-attr','InventoryAttributeController@getInventoryAttr');
    Route::post('get-inventory-attr-new-Inventory','InventoryAttributeController@getInventoryAttrOnNewInventory');
    Route::post('get-category-attr','CategoriesController@getCategoryAttr');
    Route::get('newsfeed/new','NewsfeedController@create');
    Route::post('newsfeed/new','NewsfeedController@store')->name('newsFeed');
    Route::get('newsfeed/update/{slug}/newsfeedupdate','NewsfeedController@edit'); 
    Route::put('newsfeed/update/{slug}','NewsfeedController@update');
    Route::post('newsfeed/approvement/{slug}','NewsfeedController@approvement');
    Route::put('newsfeed/reject/{slug}','NewsfeedController@reject');
    Route::resource('newsfeed','NewsfeedController');

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

// Inventory import
Route::get('attributeImport', 'ExportImportController@importExportView');
Route::get('invExport', 'ExportImportController@export')->name('export');
Route::post('invImport', 'ExportImportController@import')->name('import'); 



