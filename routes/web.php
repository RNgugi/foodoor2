<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/restaurants', 'RestaurantsController@index')->name('restaurants');

Route::get('/restaurants/explore', 'RestaurantsController@get')->name('restaurants.list');

Route::get('/restaurants/explore/cusine:{cuisine}', 'RestaurantsController@getByCuisine')->name('restaurants.list.cuisine');

Route::get('/restaurants/{restaurant}', 'RestaurantsController@show')->name('restaurants.show');



Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'namespace' => 'Admin'], function()
{
	CRUD::resource('orders', 'OrderCrudController');
	CRUD::resource('earnings', 'EarningsCrudController');
    CRUD::resource('restaurants', 'RestaurantCrudController');
    CRUD::resource('items', 'ItemCrudController');
    CRUD::resource('cuisines', 'CuisineCrudController');
    CRUD::resource('cities', 'CityCrudController');
});

