<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table 		= 	'tbl_order';
	protected $primaryKey 	=	'id';
    protected $fillable = [
        'user_id',
        'crypto_id',
        'type_id',
        'status_id',
        'limit_amount',
        'min_amount',
        'balance_amount',
        'price',
    ];

    protected $hidden = [

    ];

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function status()
    {
        return $this->belongsToMany(Status::class);
    }

    public function getOrderListByCrypto($crypto)
    {
        return  Order::select(
                    'tbl_users.username',
                    'tbl_payment_type.name AS payment',
                    'tbl_type.name AS type',
                    'tbl_status.name AS status',
                    'tbl_order.limit_amount',
                    'tbl_order.min_amount',
                    'tbl_order.balance_amount',
                    'tbl_order.price',
                    'tbl_order.id AS order_id',
                )
                ->join('tbl_cryptocurrencies', 'tbl_order.crypto_id', '=', 'tbl_cryptocurrencies.id')
                ->join('tbl_users', 'tbl_order.user_id', '=', 'tbl_users.id')
                ->join('tbl_user_payment_type', 'tbl_users.id', '=', 'tbl_user_payment_type.user_id')
                ->join('tbl_payment_type', 'tbl_user_payment_type.payment_type_id', '=', 'tbl_payment_type.id')
                ->join('tbl_type', 'tbl_order.type_id', '=', 'tbl_type.id')
                ->join('tbl_status', 'tbl_order.status_id', '=', 'tbl_status.id')
                ->where('tbl_cryptocurrencies.symbol', $crypto)
                ->get();
    }

    public function getOrderListByUser($username)
    {
        return  Order::select(
                    'tbl_cryptocurrencies.symbol',
                    'tbl_payment_type.name AS payment',
                    'tbl_type.name AS type',
                    'tbl_status.name AS status',
                    'tbl_order.limit_amount',
                    'tbl_order.min_amount',
                    'tbl_order.balance_amount',
                    'tbl_order.price',
                    'tbl_order.id AS order_id',
                )
                ->join('tbl_cryptocurrencies', 'tbl_order.crypto_id', '=', 'tbl_cryptocurrencies.id')
                ->join('tbl_users', 'tbl_order.user_id', '=', 'tbl_users.id')
                ->join('tbl_user_payment_type', 'tbl_users.id', '=', 'tbl_user_payment_type.user_id')
                ->join('tbl_payment_type', 'tbl_user_payment_type.payment_type_id', '=', 'tbl_payment_type.id')
                ->join('tbl_type', 'tbl_order.type_id', '=', 'tbl_type.id')
                ->join('tbl_status', 'tbl_order.status_id', '=', 'tbl_status.id')
                ->where('tbl_users.username', $username)
                ->orderBy('tbl_order.crypto_id', 'DESC')
                ->get();
    }

    public function createOrder($request, $userId, $cryptoId, $typeId)
    {
        return  Order::create([
                    'user_id'           => $userId,
                    'crypto_id'         => $cryptoId,
                    'type_id'           => $typeId,
                    'status_id'         => 1,
                    'limit_amount'      => $request['limitAmount'],
                    'min_amount'        => $request['minAmount'],
                    'balance_amount'    => $request['limitAmount'],
                    'price'             => $request['ratePrice'],
                ]);
    }

    public function getOrderDetailByOrderId($orderId, $orderAmount)
    {
        return  Order::select(
            'tbl_order.user_id',
            'tbl_wallet.id AS wallet_id',
            'tbl_order.crypto_id'
        )
        ->join('tbl_wallet', [
            'tbl_order.user_id'     => 'tbl_wallet.user_id',
            'tbl_wallet.crypto_id'  => 'tbl_order.crypto_id'
        ])
        ->where([
            'tbl_order.id'          => $orderId,
        ])
        ->where('tbl_order.balance_amount', '>', $orderAmount)
        ->first();
    }

    public function confirmAcceptTransferCrypto($orderId, $balanceAmount)
    {
        Order::where('id', $orderId)
            ->update([
                'balance_amount' => $balanceAmount
            ]);
    }
}
