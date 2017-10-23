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
Route::get('/','UserController@index');
Route::get('users','UserController@index');
Route::get('users/adminLogout','UserController@adminLogout');
Route::match(['put','patch'],'users/adminUpdate/{id}','UserController@adminUpdate');
Route::get('users/adminEdit/{id}','UserController@adminEdit');
Route::get('users/listUser','UserController@listUser');
Route::get('users/home','UserController@index')->name('home');
Route::match(['put','patch'],'users/update','UserController@update');
Route::get('users/edit','UserController@edit');
Route::get('users/logout','UserController@logout');
Route::post('users/login','UserController@postLogin');
Route::get('edit','UserController@getedit');
Route::get('users/login','UserController@login');
Route::resource('users','UserController',['except'=>[
    'edit','update', 'index'
]]);

Route::resource('categories','CategoryController');


//product
Route::get('products/searchByCategory/{category_id}','ProductController@searchByCategory');
Route::post('products/search','ProductController@search');
Route::resource('products','ProductController');

//picture
Route::resource('pictures','PictureController');


//cart
Route::post('carts/create/{id_product}','CartController@create');
Route::get('carts','CartController@index');
Route::delete('carts/{id}','CartController@destroy');
Route::post('carts/{id}','CartController@update');
Route::get('carts/showCart','CartController@showCart');
Route::get('carts/order', 'CartController@order');
Route::get('carts/showOrder','CartController@showOrder');
Route::get('carts/showOrderDetal/{id}','CartController@showOrderDetail');

//guest
Route::delete('guest/carts/delete/{id}','GuestController@destroy');
Route::post('guest/carts/update/{id}','GuestController@update');
Route::get('guest/carts/showCart','GuestController@showCart');
Route::get('guest/carts/checkUser','GuestController@checkOrder');


//comment
Route::post('comment/create/{id}','CommentController@create');
Route::delete('comment/delete/{id}/{id_product}','CommentController@destroy');
Route::post('comment/updateComment/{id}/{id_product}','CommentController@updateComment');

Route::get('demo','UserController@demo');
