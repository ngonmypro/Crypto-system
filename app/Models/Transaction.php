<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table 		= 	'tbl_transaction';
	protected $primaryKey 	=	'id';
    protected $fillable = [
        'sender_wallet_id',
        'receiver_wallet_id',
        'address',
        'amount',
        'crypto_id',
        'type_id',
        'payment_id',
        'status_id',
    ];

    protected $hidden = [

    ];

    public function status()
    {
        return $this->belongsToMany(Status::class);
    }

    public function createTransactionTransferCrypto($TransctionFormat)
    {
        Transaction::insert($TransctionFormat);
    }

    public function confirmAcceptPayment($paymentId, $status)
    {
        Transaction::where('payment_id', $paymentId)
            ->update([
                'status_id' => $status
            ]);
    }

    public function getTransactionByAddressAndTransactionId($request)
    {
        return  Transaction::select(
                    'tbl_transaction.id',
                    'tbl_order.user_id AS sender_user_id',
                    'tbl_payment.user_id AS receiver_user_id',
                    'tbl_payment.order_id',
                    'tbl_transaction.amount',
                    DB::raw('tbl_order.balance_amount - tbl_transaction.amount as order_balance_amount'),
                    'tbl_transaction.crypto_id',
                    'tbl_transaction.sender_wallet_id',
                    'tbl_transaction.receiver_wallet_id',
                )
                ->leftJoin('tbl_payment', 'tbl_transaction.payment_id', '=', 'tbl_payment.id')
                ->leftJoin('tbl_order', 'tbl_payment.order_id', '=', 'tbl_order.id')
                ->where([
                    'tbl_transaction.id'        => $request['transaction'],
                    'tbl_transaction.address'   => $request['address']
                ])
                ->first();
    }

    public function confirmAcceptTransfer($transactionId, $status)
    {
        Transaction::where('id', $transactionId)
            ->update([
                'status_id' => $status
            ]);
    }
}
