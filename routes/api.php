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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix'=>'v1'],function (){
  //register client
    Route::post('register-client','AuthController@registerClient');
    Route::post('login-client','AuthController@loginClient');
    Route::post('send-message-client','AuthController@sendMessageClient');
    Route::post('change-password-client','AuthController@changePasswordClient');
  //end
  //register restaurant
    Route::post('register-restaurant','AuthController@registerRestaurant');
    Route::post('login-restaurant','AuthController@loginRestaurant');
    Route::post('send-message-restaurant','AuthController@sendMessageRestaurant');
    Route::post('change-password-restaurant','AuthController@changePasswordRestaurant');
  // end
    Route::get('city','MainController@city');
    Route::get('category','MainController@category');
    Route::get('region','MainController@region');
    Route::get('list-restaurant','MainController@listRestaurant');
    Route::post('contact','MainController@contacts');
    Route::post('setting','MainController@setting');
    Route::get('offer','MainController@offer');
    Route::get('product','MainController@product');
    Route::get('payment','MainController@payment');
    Route::get('state-restaurant','MainController@stateRestaurant');
    Route::get('is-read-client','MainController@isReadClient');

    Route::group(['middleware'=>'auth:api'],function (){
        Route::post('profile-client','AuthController@profileClient');
        Route::get('order','MainController@listOrder');
        Route::post('new-order','MainController@newOrder');
        Route::post('register-token','AuthController@registerToken');
        Route::post('remove-token','AuthController@removeToken');
        Route::post('confirm-order','MainController@confirmOrder');
        Route::post('refusal-order','MainController@refusalOrder');
        Route::post('review','MainController@review');
        Route::get('notification','MainController@notification');
    });

    Route::group(['middleware'=>'auth:restaurant'],function (){
        Route::post('profile-restaurant','AuthController@profileRestaurant');
        Route::post('add-product','MainController@addProduct');
        Route::post('change-product','MainController@changeProduct');
        Route::post('delete-product','MainController@deleteProduct');
        Route::post('add-offer','MainController@addOffer');
        Route::post('change-offer','MainController@changeOffer');
        Route::post('delete-offer','MainController@delete');

    });


});
