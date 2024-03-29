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
    Route::get('get-order-by-crypto/{crypto}', 'Api\OrderController@getOrderListByCrypto');
    Route::get('get-order-by-user/{username}', 'Api\OrderController@getOrderListByUser');
    // create
    Route::post('create-order', 'Api\OrderController@createOrder');
});

Route::group(['prefix' => 'payment'], function () {
    Route::post('create-paid-amount', 'Api\PaymentController@createPaidAmount');
    Route::patch('confirm-paid-amount', 'Api\PaymentController@confirmPaidAmount');
});

Route::group(['prefix' => 'transfer'], function () {
    Route::post('create-transfer', 'Api\TransactionController@createTransferCrypto');
    Route::patch('confirm-transfer', 'Api\TransactionController@confirmTransferCrypto');
});
