<?php

use Illuminate\Http\Request;

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

Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');

Route::post('/phone/sendotp', 'Api\ProfileController@sendOTP');
Route::post('/phone/store', 'Api\ProfileController@store');




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
