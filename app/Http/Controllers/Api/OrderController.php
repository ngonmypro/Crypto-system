<?php

namespace App\Http\Controllers\Api;

use DB;

use App\Models\Cryptocurrencies;
use App\Models\Exchange_Rate;
use App\Models\User;
use App\Models\Order;
use App\Models\Type;
use App\Models\Wallet;

use App\Domain\OrderDomain;
use App\Domain\CurrencyDomain;
use App\Enums\TypeName;
use App\Libraries\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function createOrder(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'username'      => 'required|string',
                'crypto'        => 'required|string|max:5',
                'type'          => 'required|string',
                'limitAmount'  => 'required|numeric|min:0',
                'minAmount'    => 'required|numeric|min:0',
                'ratePrice'    => 'required|numeric|min:0',
            ]);
            if ($validate->fails()) return JsonResponse::messageResponse($validate->errors()->messages(), 400);

            $verifyUser = User::getUserByUsername($request->username);
            if(!$verifyUser) return JsonResponse::messageResponse('User not found.', 401);

            $verifyCrypto = Cryptocurrencies::getCryptoByOrderCrypto(strtoupper($request->crypto));
            if(!$verifyCrypto) return JsonResponse::messageResponse('Crypto not support.', 401);

            if (strtoupper($request->type) == TypeName::SELL) {
                $checkBalanceCrypto = Wallet::checkBalanceSellCryptoByUser($verifyCrypto->id, $verifyUser->id);
                if($request->limitAmount > $checkBalanceCrypto->balance) return JsonResponse::messageResponse('Order sell limit over balance.', 401);
            }

            $verifyType = Type::getTypeByOrderType(strtoupper($request->type));
            if(!$verifyType && !in_array(strtoupper($request->type), TypeName::ORDER_TYPE)) return JsonResponse::messageResponse('Type order not support.', 401);

            DB::beginTransaction();
            Order::createOrder($request->all(), $verifyUser->id, $verifyCrypto->id, $verifyType->id);

            DB::commit();
            return JsonResponse::messageResponse("Create New Order Success", 200);
        } catch (\Exception $e) {
            DB::rollback();
            return JsonResponse::messageResponse($e->getMessage(), 500);
        }
    }
}
