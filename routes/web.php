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

Route::resource('artikelen','ProductController');
Route::group(['middleware' => 'GuestCheck'], function () {
$this->post('logout', 'Auth\LoginController@logout');
Route::get('user/edit', 'UserController@useredit');
Route::post('user/edit', 'UserController@userupdate');
Route::get('user/show', 'UserController@showcurrent');
Route::get('user/password', 'UserController@passwordchange');
Route::put('user/password', 'UserController@storepasswordchange');


});
Route::group(['middleware' => 'AdminCheck'], function () {
		Route::get('/admin', 'ProductController@index');
		Route::get('admin/gallerie', 'ExtraController@gallery');
		Route::put('admin/users/{id}/password','UserController@passwordreset');
	Route::resource('admin/users','UserController');
});

//Orders
Route::get('cart', 'OrderController@cart')->name('cart');
Route::resource('orders','OrderController',['only'=>['index', 'show', 'remove']]);

//Navigation
foreach(\App\NavigationItem::where('child_from', null)->get() as $parent)
{
    $this->get($parent->route, $parent->action);
    foreach(\App\NavigationItem::where('child_from', $parent->id)->get() as $child)
    {
        $this->get($child->route, $child->action);
    }
}