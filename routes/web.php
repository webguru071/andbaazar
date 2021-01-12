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
// use Twilio\Rest\Client;
route::get('some-expriment',function(){
    // require __DIR__ . '/../vendor/autoload.php';

    // // Your Account SID and Auth Token from twilio.com/console
    // $account_sid = 'ACf2f48bab7c7046d2827512e3c57a83c1';
    // $auth_token = 'ff9b2cc2637559464e4fa87b863920f5';
    // // In production, these should be environment variables. E.g.:
    // // $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]

    // // A Twilio number you own with SMS capabilities
    // $twilio_number = "+18328030969";

    // $client = new Client($account_sid, $auth_token);
    // $d = $client->messages->create(
    //     // Where to send a text message (your cell phone?)
    //     '+8801517808275',
    //     array(
    //         'from' => $twilio_number,
    //         'body' => 'I sent this message in under 10 minutes!'
    //     )
    // );
    // dd($d);

    $user = App\User::find(18);

    $user->notify(new App\Notifications\PhoneVerification($user));
    echo 'dd';
    dd($user);

    // is_dir("/home/andbaazar/domains/andbaazar.com/public_html/app");
    // $d = symlink('/home/andbaazar/domains/andbaazar.com/app/storage/app/public','/home/andbaazar/domains/andbaazar.com/public_html/app/storage');
    // dd($d);
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





