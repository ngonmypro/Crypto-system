<?php

namespace App\Http\Controllers\Api;

use App\Domain\TransactionDomain;
use DB;

use App\Models\Type;
use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Payment_Type;
use App\Models\Transaction;

use App\Enums\TypeName;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Libraries\JsonResponse;

class PaymentController extends Controller
{
    public function createPaidAmount(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'username'      => 'required|string',
                'order'         => 'required|numeric|min:0',
                'type'          => 'required|string',
                'paymentMethod' => 'required|string|min:0',
                'paidAmount'    => 'required|numeric|min:0',
                'orderAmount'   => 'required|numeric|min:0',
            ]);
            if ($validate->fails()) return JsonResponse::messageResponse($validate->errors()->messages(), 400);

            $verifyOrder = Order::getOrderDetailByOrderId($request->order, $request->orderAmount);
            if(!$verifyOrder) return JsonResponse::messageResponse('Payment order fail. '.$request->type.' order amount over balance limit.', 401);

            $verifyUser = User::getUserAndWalletByUsername($request->username, $verifyOrder->crypto_id);
            if(!$verifyUser) return JsonResponse::messageResponse('User not found.', 401);

            $verifyPaymentType = Payment_Type::getPaymentTypeByOwnerOrder(strtoupper($request->paymentMethod), $verifyOrder->user_id);
            if(!$verifyPaymentType) return JsonResponse::messageResponse('Payment type owner order not support.', 401);

            $verifyType = Type::getTypeByOrderType(strtoupper($request->type));
            if(!$verifyType && !in_array(strtoupper($request->type), TypeName::ORDER_TYPE)) return JsonResponse::messageResponse('Type order not support.', 401);

            DB::beginTransaction();
            $resultPayment = Payment::createPaymentPaidOrder($request->all(), $verifyUser->id, $verifyPaymentType->id, $verifyType->id);

            $setTransctionFormat = TransactionDomain::setFormatTransactionTransferCrypto($resultPayment, $verifyUser, $verifyOrder);
            Transaction::createTransactionTransferCrypto($setTransctionFormat);

            DB::commit();
            return JsonResponse::messageResponse("Create Paid Amount Order Success", 200);
        } catch (\Exception $e) {
            DB::rollback();
            return JsonResponse::messageResponse($e->getMessage(), 500);
        }
    }

    public function confirmPaidAmount(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'username'  => 'required|string',
                'payment'   => 'required|numeric|min:0',
            ]);
            if ($validate->fails()) return JsonResponse::messageResponse($validate->errors()->messages(), 400);

            $verifyPayment = Payment::getPaymentByUsernameAndPaymentId($request->all());
            if(!$verifyPayment) return JsonResponse::messageResponse('Payment not found or you not owner order.', 401);

            DB::beginTransaction();
            Payment::confirmAcceptPayment($verifyPayment->id, 3);
            Transaction::confirmAcceptPayment($verifyPayment->id, 2);

            DB::commit();
            return JsonResponse::messageResponse("Confirm accept Amount Order Success", 200);
        } catch (\Exception $e) {
            DB::rollback();
            return JsonResponse::messageResponse($e->getMessage(), 500);
        }
    }
}
