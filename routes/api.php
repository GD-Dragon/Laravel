<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('buycart','BuycartController@buycart');
	Route::post('buy','BuycartController@buy');
	Route::post('address','AddressController@address');
	Route::post('member_address','AddressController@member_address');
	Route::post('show','AddressController@show');
	Route::post('cart_two','Buycart_TwoController@cart_two');
    Route::post('cart_two1','Buycart_TwoController@cart_two1');
    Route::post('add','Buycart_TwoController@add');
    Route::get('index','PayController@index');
    Route::get('return','PayController@return');
    Route::get('notify','PayController@notify');
});

Route::get('users/{user}', function (App\User $user) {
    dd($user);
});

Route::get('goods/show','GoodsController@show');

Route::get('goods/tree','GoodsController@tree');

Route::get('goods/floor','GoodsController@floor');

Route::get('goods/category','GoodsController@category');

Route::post('product/shop','ProductController@shop');

Route::post('product/product','ProductController@product');

Route::post('shopcart/shopcart','ShopcartController@shopcart');

Route::post('shopcart/cart','ShopcartController@cart');


