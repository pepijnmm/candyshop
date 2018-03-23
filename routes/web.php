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

Route::post('fileUpload','ExtraController@fileUpload');
Route::get('/', 'PublicController@index');
Route::get('about', 'PublicController@about');

Route::resource('artikelen','ProductController',['only'=>['show']]);
Route::group(['middleware' => 'GuestCheck'], function () {

});
Route::group(['middleware' => 'AdminCheck'], function () {
	Route::resource('admin/artikelen','ProductController');

	Route::get('gallerie', 'ExtraController@gallery');
	Route::get('admin', function () {

		return redirect()->action('ProductController@index');
	});
});

//Orders
Route::get('cart', 'OrderController@cart')->name('cart');
Route::resource('orders','OrderController',['only'=>['index', 'show']]);