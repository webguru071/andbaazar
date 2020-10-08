<?php



Route::get('andbaazaradmin/login','AuthController@adminlogin');
Route::post('andbaazaradmin/login','AuthController@adminloginprocess')->name('loginproces');


Route::middleware(['auth','admin'])->prefix('andbaazaradmin')->group(function (){
// Route::prefix('andbaazaradmin')->group(function () {
    Route::get('dashboard','AdminHomeController@dashboard');
    Route::get('products/category-tree-view',['uses'=>'CategoriesController@manageCategory']);
    Route::get('categories/update/{id}/edit','CategoriesController@edit');
    Route::put('categories/update/{id}','CategoriesController@update');
    Route::resource('categories','CategoriesController');
    Route::get('/category/attribute/{slug}/attribute','CatAttributeController@attribute');
    Route::put('/category/attribute','CatAttributeController@attributeset');
    // Route::get('/category/attribute/{slug}/attribute','CatAttributeController@attribute');
    Route::resource('/category','CatAttributeController');
    Route::get('products/subcategory-tree-view',['uses'=>'CategoriesController@manageSubCategory']);
    Route::put('/add-category','CategoriesController@addCategory')->name('add.category');
    // Route::post('/add-category',['as'=>'add.category','uses'=>'CategoriesController@addCategory']);
    Route::resource('products/category','CategoriesController');
    Route::resource('/child','ChildrenController');
    Route::resource('/paymentmethod','PaymentMethodsController');
    Route::resource('/shippingmethod','ShippingMethodsController');
    Route::resource('promotion','PromotionsController');
    Route::resource('/promotionhead','PromotionHeadsController');
    Route::resource('/promotionplan','PromotionPlansController');
    Route::resource('/currency','CurrenciesController');
    Route::resource('/courier','CouriersController'); 
    //Route::get('/seller','SellersController@index');
    Route::post('/reject-name','RejectListController@other');
    Route::resource('/reject','RejectListController'); 
    Route::get('/merchant','MerchantController@index');
    Route::get('/newsfeed','NewsfeedController@feedlist');
    Route::get('/contact-us','ContactController@contactmailList');
    Route::put('/contact-us/{id}','ContactController@replayMail');

    Route::resource('products/size','SizesController');
    Route::resource('products/tag','TagsController');
    Route::resource('products/color','ColorsController');
    Route::resource('products/brand','BrandController');

    Route::get('e-commerce/products/','ProductsController@productList');
    Route::get('products/AllProduct','ProductsController@productTableList');

    // SME Product list start //

    Route::get('sme/products/','SmeProductController@smeproductList');

   // SME Product list start //

   //Auctionproduct list start

   Route::get('auction/products/','AuctionproductController@auctionProductList');

    Route::get('color-image/{color_slug}','ProductsController@colorWiseImage');

   Route::resource('/shop','ShopsController');

   Route::get('category_setup','CategorySetupController@index');


//    Krishi Product  Start //

Route::get('krishi/products/','KrishiProductController@krishiProductList');


// Route::resource('products/krishi/category','KrishiCategoryController');


// Attribute import

Route::get('attribute-import', 'ExportImportController@importExportView');
Route::post('attribute-import','ExportImportController@import')->name('attributestore');

Route::get('export', 'ExportImportController@export')->name('export');

 
});

// Category import
Route::get('categoryImport', 'CategoryExportImportController@CategoryImportView');
Route::get('catExport', 'CategoryExportImportController@export')->name('catexport');
Route::post('catImport', 'CategoryExportImportController@import')->name('catimport');

