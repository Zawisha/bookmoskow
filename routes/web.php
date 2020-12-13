<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::get('/', 'IndexController@index')->where('any', '.*')->name('main');

Route::get('/test', 'IndexController@set_time')->name('test');

Route::get('/change_images', 'PicController@change_images');

//Route::get('/{any}', 'IndexController@index')->where('any', '.*')->name('main');

//Route::get('send','mailController@send');
Route::get('/unsub_email/{user_email}&{email_token}','ViewRedirectController@unsubView');

//Route::get('/cupon_info','InfoFromDbViewController@cupon_info')->name('cupon_info')->middleware('auth');
Route::get('/cupon_info', 'CuponDateRangeController@index')->middleware('auth');
Route::post('/cupon_info/fetch_data', 'CuponDateRangeController@fetch_data')->name('cuponDateRange.fetch_data');

Route::get('/dropcart_info', 'DropcartDateRangeController@index')->middleware('auth');
Route::post('/dropcart_info/fetch_data', 'DropcartDateRangeController@fetch_data')->name('dropCartDateRange.fetch_data');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
//Route::get('/home', 'HomeController@index')->name('home');
