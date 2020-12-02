<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, X-Auth-Token, Origin, Authorization');


Route::post('/save_posts_admin', 'IndexController@test_api');
Route::post('/get_groupsofgoods', 'IndexController@get_groupsofgoods');
Route::post('/get_good', 'IndexController@get_good');
Route::post('/set_time', 'IndexController@set_time');

Route::post('/second_remind', 'SecondCartRemindController@second_remind');
Route::post('/third_remind', 'ThirdCartRemindController@third_remind');

Route::post('/add_good', 'ApiController@add_good');
Route::post('/delete_good', 'ApiController@delete_good');
Route::post('/delete_order', 'ApiController@delete_order');

Route::post('/send_cupon', 'SendCuponController@send_cupon');

Route::middleware('auth:api')->group( function () {
});
