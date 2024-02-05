<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Models\User;
use App\Enums\Person;

use App\Models\Order;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Libraries\JsonResponse;
use App\Models\Cryptocurrencies;
use App\Domain\TransactionDomain;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function createTransferCrypto(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'username'          => 'required|string',
                'crypto'            => 'required|string',
                'transferAmount'    => 'required|numeric|min:0',
                'address'           => 'required|string',
            ]);
            if ($validate->fails()) return JsonResponse::messageResponse($validate->errors()->messages(), 400);

            $verifyCrypto = Cryptocurrencies::getCryptoByOrderCrypto(strtoupper($request->crypto));
            if(!$verifyCrypto) return JsonResponse::messageResponse('Crypto not support.', 401);

            $verifyWallet = User::getUserAndWalletByUsername($request->username, $verifyCrypto->id);
            if(!$verifyWallet || $verifyWallet->balance < $request->transferAmount) return JsonResponse::messageResponse('Wallet crypto not found or wallet balance lower amount transfer crypto.', 401);

            $setTransctionFormat = TransactionDomain::setDataTransferCrypto($verifyWallet, $verifyCrypto->id, $request->all());

            DB::beginTransaction();
            Transaction::createTransactionTransferCrypto($setTransctionFormat);

            DB::commit();
            return JsonResponse::messageResponse("Confirm accept transfer crypto Success", 200);
        } catch (\Exception $e) {
            DB::rollback();
            return JsonResponse::messageResponse($e->getMessage(), 500);
        }
    }

    public function confirmTransferCrypto(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'address'       => 'required|string',
                'transaction'   => 'required|numeric|min:0',
            ]);
            if ($validate->fails()) return JsonResponse::messageResponse($validate->errors()->messages(), 400);

            $verifyTransaction = Transaction::getTransactionByAddressAndTransactionId($request->all());
            // return $verifyTransaction;
            if(!$verifyTransaction) return JsonResponse::messageResponse('Transaction not found or you not owner transaction.', 401);

            DB::beginTransaction();

            if (!empty($verifyTransaction->id)) {
                Transaction::confirmAcceptTransfer($verifyTransaction->id, 3);
            }

            if (!empty($verifyTransaction->order_id) && !empty($verifyTransaction->order_balance_amount)) {
                Order::confirmAcceptTransferCrypto($verifyTransaction->order_id, $verifyTransaction->order_balance_amount);
            }

            if (
                !empty($verifyTransaction->sender_user_id)
                && !empty($verifyTransaction->sender_wallet_id)
                && !empty($verifyTransaction->crypto_id)
                && !empty($verifyTransaction->amount)
            ) {
                Wallet::confirmTransferCrypto($verifyTransaction->sender_user_id, $verifyTransaction->sender_wallet_id, $verifyTransaction->crypto_id, $verifyTransaction->amount, Person::SENDER);
            }

            if (
                !empty($verifyTransaction->receiver_user_id)
                && !empty($verifyTransaction->receiver_wallet_id)
                && !empty($verifyTransaction->crypto_id)
                && !empty($verifyTransaction->amount)
            ) {
                Wallet::confirmTransferCrypto($verifyTransaction->receiver_user_id, $verifyTransaction->receiver_wallet_id, $verifyTransaction->crypto_id, $verifyTransaction->amount, Person::RECEIVER);
            }

            DB::commit();
            return JsonResponse::messageResponse("Confirm accept transfer crypto Success", 200);
        } catch (\Exception $e) {
            DB::rollback();
            return JsonResponse::messageResponse($e->getMessage(), 500);
        }
    }
}
