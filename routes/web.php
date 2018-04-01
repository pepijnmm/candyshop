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


// Auth::routes();

$this->get('login', 'Auth\LoginController@showLoginForm');
$this->post('login', 'Auth\LoginController@login');

Route::get('register', 'UserController@register');
Route::post('register', 'UserController@userstore');


Route::get('/', 'PublicController@index');
Route::get('about', 'PublicController@about');
Route::resource('artikelen','ProductController',['only'=>['show']]);
Route::group(['middleware' => 'GuestCheck'], function () {
$this->post('logout', 'Auth\LoginController@logout');
//user settings
Route::get('user', function () {
     return redirect('user/show');
});
Route::get('user/edit', 'UserController@useredit');
Route::post('user/edit', 'UserController@userupdate');
Route::get('user/show', 'UserController@showcurrent');
Route::get('user/password', 'UserController@passwordchange');
Route::put('user/password', 'UserController@storepasswordchange');


});
Route::group(['middleware' => 'AdminCheck'], function () {
	Route::get('admin', function () {
     return redirect('admin/artikelen');
});
	Route::get('admin/gallerie', 'ExtraController@gallery');
	Route::put('admin/users/{id}/password','UserController@passwordreset');
	Route::resource('admin/users','UserController');
	Route::resource('admin/categories','CategoryController');
	Route::resource('admin/artikelen','ProductController',['except'=>['show']]);
	Route::get('admin/artikelen/{id}', 'ProductController@showadmin');
});

//Orders
Route::get('bestelling/cart', 'OrderController@cart');
Route::get('bestelling/checkout', 'OrderController@checkout');
Route::put('bestelling/checkout', 'OrderController@checkoutstore');
Route::resource('bestelling','OrderController',['only'=>['index', 'show']]);
Route::post('artikelen/{product}/remove', 'OrderController@remove');
Route::post('artikelen/{product}/add', 'OrderController@add');

//Categories
Route::get('artikelen/categorie/{category}', 'PublicController@showProducts');
Route::get('artikelen/categorie/{category}/zoeken', 'PublicController@search');
Route::any('/{any}', function ($any) {
     return redirect('/');
});
