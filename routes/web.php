<?php

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

Route::get('/', function () {
    return view('welcome');
});
//,'auto-check-permission' middleware
Route::get('/logout', function () {
    Auth::guard('web')->logout();
    return redirect(url('login'));
});
Auth::routes();
Route::group(['middleware' => ['auto-check-permission']] , function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('reset-password', 'HomeController@resetPassword')->name('resetPassword');
    Route::get('reset-password', 'HomeController@resetPasswordView')->name('resetPassword');
    Route::resource('city', 'CityController');
    Route::resource('category', 'CategoryController');
    Route::resource('region', 'RegionController');
    Route::resource('setting', 'SettingController');
    Route::resource('payment', 'PaymentController');
    Route::resource('offer', 'OfferController');
    Route::resource('contact', 'ContactController');
    Route::resource('payments', 'RestorauntPaymentController');
    Route::resource('client', 'ClientController');
    Route::get('client/{id}/active', 'ClientController@active');
    Route::get('client/{id}/deactive', 'ClientController@deactive');
    Route::resource('restaurant', 'RestauranrController');
    Route::get('client/{id}/active', 'RestauranrController@active');
    Route::get('client/{id}/deactive', 'RestauranrController@deactive');
    Route::resource('order', 'OrderController');
    Route::resource('user','UserController');
    Route::resource('role','RoleController');
});

Route::group(['namespace'=>'front'],function (){
    Route::get('index', 'MainController@home');
    Route::get('contact', 'MainController@viewContact');
    Route::post('contact', 'MainController@contact');
    Route::get('addorder', 'client\MainController@addOrder');
    Route::get('register-client', 'client\AuthController@viewRegisterClient');
    Route::post('register-client', 'client\AuthController@registerClient');
    Route::get('login-client', 'client\AuthController@viewLoginClient');
    Route::post('login-client', 'client\AuthController@loginClient');
    Route::get('list-product/{id}', 'client\MainController@listProduct');
    Route::get('product-details/{id}', 'client\MainController@productDetails');
    Route::get('update/{id}', 'client\MainController@updates');
    Route::get('/logout', function () {
        Auth::guard('client-web')->logout();
        return redirect(url('login-client'));
    });
//    Route::get('reviews', 'client\MainController@viewReviews');
//    Route::get('message', 'client\MainController@reviews');
    Route::get('city/{id}/regions',function ($id){
        return responseJson(1, 'success', \App\Models\City::findOrFail($id)->regions()->get());});

    Route::group(['middleware'=>'auth:client-web'],function() {
        Route::get('addorder', 'client\MainController@addOrder');
        Route::post('addorder', 'client\MainController@newOrder');
        Route::get('alert', 'client\MainController@viewAlert');
        Route::get('previous-order', 'client\MainController@previousOrder');
        Route::get('reviews/{id}', 'client\MainController@viewReviews');
        Route::post('review', 'client\MainController@reviews');
        Route::get('add-cart/{product}', 'client\MainController@addCart');
        Route::get('show-cart', 'client\MainController@showCart');
        Route::delete('remove-cart/{product}', 'client\MainController@destroyCart');
        Route::put('update-cart/{product}', 'client\MainController@updateCart');
        Route::get('checkout/{amount}', 'client\MainController@checkout');
        Route::post('charge', 'client\MainController@charge');
//        Route::get('add-order', 'client\MainController@newOrder');
        Route::get('client-profile', 'client\AuthController@viewProfile');
        Route::post('client-profile', 'client\AuthController@profile');
        Route::get('client-change-password', 'client\AuthController@viewChangePassword');
        Route::post('client-change-password', 'client\AuthController@changePassword');

    });
//    Route::group(['prefix' =>'restaurant'],function() {
    Route::get('/logout', function () {
        Auth::guard('restaurant-web')->logout();
        return redirect(url('login-restaurant'));
    });
        Route::get('register-restaurant', 'AuthController@viewRegisterRestaurant');
        Route::post('register-restaurant', 'AuthController@registerRestaurant');
        Route::get('login-restaurant', 'AuthController@viewLoginRestaurant');
        Route::post('login-restaurant', 'AuthController@loginRestaurant');
        Route::group(['middleware'=>'auth:restaurant-web'],function() {
            Route::get('addproduct', 'MainController@viewAddProduct');
            Route::post('addproduct', 'MainController@addProduct');
            Route::get('restaurantseller','MainController@Product');
            Route::get('addlistoffer', 'MainController@addListOffer');
            Route::get('addoffer', 'MainController@viewAddOffer');
            Route::post('addoffer', 'MainController@addOffer');
            Route::get('listoffer', 'MainController@offer');
            Route::get('editproduct/{id}', 'MainController@viewUpdate');
            Route::post('updateproduct/{id}', 'MainController@update');
            Route::get('deletproduct/{id}', 'MainController@deleteProduct');
            Route::get('editoffer/{id}', 'MainController@viewEditOffer');
            Route::post('editoffer/{id}', 'MainController@EditOffer');
            Route::get('deleteoffer/{id}', 'MainController@deleteOffer');
            Route::get('new-order-requests', 'MainController@newOrderRequests');
            Route::get('acceptances/{id}', 'MainController@acceptance');
            Route::get('refusal/{id}', 'MainController@refusal');
            Route::get('restaurant-profile', 'AuthController@viewProfile');
            Route::post('restaurant-profile', 'AuthController@profile');
            Route::get('restaurant-change-password','AuthController@viewChangePassword');
            Route::post('restaurant-change-password','AuthController@changePassword');
//    });
        });




});
