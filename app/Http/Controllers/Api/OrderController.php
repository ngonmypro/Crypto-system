<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
// use DB;
use App\Domain\OrderDomain;
use Illuminate\Http\Request;
use App\Models\Exchange_Rate;
use App\Domain\CurrencyDomain;
use App\Libraries\JsonResponse;
use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function getOrderListByCrypto(Request $request, $crypto)
    {
        $currency = CurrencyDomain::checkCurrency($request->currency);
        $resultExchange = Exchange_Rate::getRateExchange($currency);

        $resultsOrder = Order::getOrderListByCrypto($crypto);
        $results = OrderDomain::setFormatOrderByCrypto($crypto, $resultsOrder, $resultExchange);

        return JsonResponse::messageResponse("Get Order List Completed", 200, $results);
    }

    public function getOrderListByUser(Request $request, $username)
    {
        $currency = CurrencyDomain::checkCurrency($request->currency);
        $resultExchange = Exchange_Rate::getRateExchange($currency);

        $resultsOrder = Order::getOrderListByUser($username);
        $results = OrderDomain::setFormatOrderByUser($username, $resultsOrder, $resultExchange);

        return JsonResponse::messageResponse("Get Order By User Completed", 200, $results);
    }

    // public function createUser(Request $request)
    // {
    //     try {
    //         $validate = Validator::make($request->all(), [
    //             'username'  => 'required|string|unique:tbl_users',
    //             'email'     => 'required|string|email|unique:tbl_users',
    //             'password'  => 'required|string|min:6'
    //         ]);

    //         if ($validate->fails()){
    //             return JsonResponse::messageResponse($validate->errors()->messages(), 400);
    //         }
    //         DB::beginTransaction();
    //         $resultUserDetail = User::createUser($request->all());
    //         $resultWalletDetail = Wallet::createDefaultWalletNewUser((object) $resultUserDetail);

    //         DB::commit();
    //         return JsonResponse::messageResponse("Create New User Success", 200);
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return JsonResponse::messageResponse($e->getMessage(), 500);
    //     }
    // }

    // public function getWalletByUser($username)
    // {
    //     $resultUser = User::getWalletByUser($username);
    //     $result = UserDomain::setFormatUserWallet($resultUser);

    //     return JsonResponse::messageResponse("Get User Completed", 200, $result);
    // }
}
