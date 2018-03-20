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

//Route::get('/', function () {
//    return view('welcome');
//});


Auth::routes();
Route::get('/', 'PublicController@index');
Route::resource('products','ProductController',['only'=>['show']]);
//Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'GuestCheck'], function () {
    Route::group(['middleware' => 'AdminCheck'], function () {
        Route::resource('products','ProductController',['except'=>['show']]);
    });
});

//Orders
Route::get('/cart', 'OrderController@cart')->name('cart');
Route::resource('orders','OrderController',['only'=>['index', 'show']]);