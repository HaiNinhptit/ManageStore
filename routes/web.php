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
