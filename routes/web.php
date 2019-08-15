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


Route::get('login', function () {
    return view('login');
});

// Route::get('loginaction', function () {
//     return view('loginAction');
// });

// Route::get('show', function () {
//     return view('show');
// });
Route::get('login/show','LoginController@show');

Route::get('login/tree','LoginController@tree');

Route::get('login/floor','LoginController@floor');

Route::get('login/category','LoginController@category');

Route::get('loginAction','LoginController@loginAction');

Route::get('login/loginout','LoginController@loginout');

Route::get('/signin', "AuthController@signin");

Route::group(['middleware' => ['auth:api']], function(){
    Route::get('menu', 'MenuController@index');
});

Route::match(['get', 'post'], 'foo', function () {
    return 'This is a request from get or post';
});
Route::get('/aa', function () {
   echo $hashed = Hash::make('bb');
});