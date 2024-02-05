<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'users'], function () {
    Route::get('get-user-list', 'Api\UsersController@getUserList');
    Route::post('create-user', 'Api\UsersController@createUser');

    Route::get('get-wallet-by-user/{username}', 'Api\UsersController@getWalletByUser');
});

Route::group(['prefix' => 'trade'], function () {
    Route::group(['prefix' => 'get-order-list'], function (){
        Route::get('{crypto}', 'Api\OrderController@getOrderListByCrypto');
        Route::get('{username}', 'Api\OrderController@getOrderListByUser');
    });
    // BUY
    // Route::post('', '');

    // SELL
    // Route::get('', '');
    // Route::post('', '');
});

Route::group(['prefix' => 'payment'], function () {

});

Route::group(['prefix' => 'transfer'], function () {

});