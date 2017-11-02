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

Route::group(['prefix' => 'products'], function (){
    Route::get('searchByCategory/{category_id?}','ProductController@searchByCategory');
    Route::get('search/{category_id?}','ProductController@search');
    Route::get('{product}','ProductController@show');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('login','UserController@adminLogin');
    Route::post('login','UserController@adminPostLogin');
    Route::get('adminLogout','UserController@adminLogout');
    Route::match(['put','patch'],'adminUpdate/{id}','UserController@adminUpdate');
    Route::delete('{id}','UserController@destroy');
    Route::get('adminEdit/{id}','UserController@adminEdit');
    Route::get('listUser','UserController@listUser');
    Route::resource('categories','CategoryController');
    Route::resource('products','ProductController');
    Route::resource('pictures','PictureController');
});
Route::get('/','UserController@index');

Route::group(['prefix' => 'users'], function (){
    Route::get('/','UserController@index');
    Route::get('home','UserController@index')->name('home');
    Route::match(['put','patch'],'update','UserController@update');
    Route::get('edit','UserController@edit');
    Route::get('logout','UserController@logout');
    Route::post('login','UserController@postLogin');
    Route::get('login','UserController@login');
    Route::resource('/','UserController',['except'=>[
        'edit','update', 'index','destroy',
    ]]);
});



Route::group(['prefix' => 'carts'], function (){
    Route::post('create/{id_product}','CartController@create');
    Route::get('/','CartController@index');
    Route::delete('{id}','CartController@destroy');
    Route::post('{id}','CartController@update');
    Route::get('showCart','CartController@showCart');
    Route::get('order', 'CartController@order');
    Route::get('showOrder','CartController@showOrder');
    Route::get('showOrderDetal/{id}','CartController@showOrderDetail');
});

Route::group(['prefix' => 'guest'], function (){
    Route::delete('carts/delete/{id}','GuestController@destroy');
    Route::post('carts/update/{id}','GuestController@update');
    Route::get('carts/showCart','GuestController@showCart');
    Route::get('carts/checkUser','GuestController@checkOrder');
});


Route::group(['prefix' => 'comment'], function (){
    Route::post('create/{id}','CommentController@create');
    Route::delete('delete/{id}/{id_product}','CommentController@destroy');
    Route::post('updateComment/{id}/{id_product}','CommentController@updateComment');
});

Route::get('form','DemoController@getForm');
Route::post('xuLy','DemoController@xuLy');
Route::get('user/confirm/{random_check}','UserController@confirmEmail');
Route::get('user/sendMail','UserController@getFormSendMail');
Route::post('user/sendMail','UserController@postFormSendMail');
Route::get('user/resetpassword/{email}/{token}','UserController@getFormNewPassword');
Route::post('user/resetpassword/{email}/{token}','UserController@postNewPassword');
Route::get('user/resetPwdSuccess','UserController@getResetPwdSuccess');

