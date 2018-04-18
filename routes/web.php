<?php

Route::get('/', function () {
	//return redirect('/restaurants');
    return view('welcome');
});

Auth::routes();


Route::get('/verify-otp', 'OtpController@index');
Route::post('/verify-otp', 'OtpController@store');

Route::group(['middleware' => ['verified'] ], function() {


    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/restaurants', 'RestaurantsController@index')->name('restaurants');

    Route::get('/restaurants/explore', 'RestaurantsController@get')->name('restaurants.list');

    Route::get('/restaurants/explore/cusine:{cuisine}', 'RestaurantsController@getByCuisine')->name('restaurants.list.cuisine');

    Route::get('/restaurants/{restaurant}', 'RestaurantsController@show')->name('restaurants.show');

    Route::post('/orders', 'OrdersController@store');

    Route::get('/orders', 'OrdersController@index');

    Route::get('/orders/{order}', 'OrdersController@show');

    Route::get('/orders/{order}/pay', 'PaymentsController@addMoney');

    Route::get('/payments/response/', 'PaymentsController@response');

    Route::get('/checkout', 'CheckoutController@index');

    Route::get('/checkout/success', 'CheckoutController@success');

    Route::get('/cart/add/{item}', 'CartController@add');

    Route::post('/cart/add/{item}/custom', 'CartController@customAdd');

    Route::get('/cart/remove/{item}/{restaurant}', 'CartController@remove');

    Route::get('/cart/increment/{item}/{restaurant}', 'CartController@increment');

    Route::get('/cart/decrement/{item}/{restaurant}', 'CartController@decrement');

    Route::get('/coupons/apply/{restaurant}/coupon:{code}', 'CouponsController@apply');

    Route::get('/coupons/apply/{restaurant}/coupon:{code}/remove', 'CouponsController@remove');

    
});

Route::post('/bulk-orders', 'BulkOrderController@store');


Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'namespace' => 'Admin'], function()
{
	CRUD::resource('orders', 'OrderCrudController');
	CRUD::resource('earnings', 'EarningsCrudController');
    CRUD::resource('restaurants', 'RestaurantCrudController');
    CRUD::resource('items', 'ItemCrudController');
    CRUD::resource('cuisines', 'CuisineCrudController');
    CRUD::resource('cities', 'CityCrudController');
    CRUD::resource('coupons', 'CouponCrudController');
    CRUD::resource('drivers', 'DriverCrudController');
    CRUD::resource('freedeliveries', 'FreedeliveryCrudController');
    CRUD::resource('toppings', 'ToppingCrudController');
});

Route::group(['prefix' => 'restaurants-admin', 'middleware' => ['admin'], 'namespace' => 'Restaurants'], function()
{
	Route::get('/', 'DashboardController@dashboard');
	CRUD::resource('orders', 'OrderCrudController');
	CRUD::resource('earnings', 'EarningsCrudController');
    CRUD::resource('restaurants', 'RestaurantCrudController');
    CRUD::resource('items', 'ItemCrudController');
    CRUD::resource('coupons', 'CouponCrudController');
    CRUD::resource('freedeliveries', 'FreedeliveryCrudController');
});

