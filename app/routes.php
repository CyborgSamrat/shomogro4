<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('uses'=>'StoreController@getIndex'));

Route::controller('admin/categories', 'CategoriesController');
Route::controller('/products', 'ProductsController');
Route::controller('store', 'StoreController');
Route::controller('users', 'UsersController');

Route::post('/user/newaccount', [
    "before" => "csrf",
    'uses'   => 'UsersController@postCreate',
    "as" => "user.create"
]);

Route::post('/login', [
    "before" => "csrf",
    "uses"   => 'UsersController@postSignin',
    "as"     => "user.login"
]);

Route::post('/login', [
    "before" => "csrf",
    "uses"   => 'UsersController@postSignin',
    "as"     => "user.login"
]);