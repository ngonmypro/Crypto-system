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
                    'tbl_cryptocurrencies.symbol',
                    'tbl_users.username',
                    'tbl_payment_type.name',
                    'tbl_type.name',
                    'tbl_status.name',
                    'tbl_order.limit_amount',
                    'tbl_order.min_amount',
                    'tbl_order.balance_amount',
                )
                ->join('tbl_cryptocurrencies', 'tbl_order.crypto_id', '=', 'tbl_cryptocurrencies.id')
                ->join('tbl_users', 'tbl_order.user_id', '=', 'tbl_users.id')
                ->join('tbl_user_payment_type', 'tbl_users.id', '=', 'tbl_user_payment_type.user_id')
                ->join('tbl_payment_type', 'tbl_user_payment_type.payment_type_id', '=', 'tbl_payment_type.id')
                ->join('tbl_type', 'tbl_order.type_id', '=', 'tbl_type.id')
                ->join('tbl_status', 'tbl_order.status_id', '=', 'tbl_status.id')
                ->get();

        // User::select(
        //     'tbl_users.username',
        //     'tbl_users.email',
        //     self::convertRole(),
        //     'tbl_cryptocurrencies.symbol',
        //     'tbl_wallet.balance',
        //     'tbl_wallet.address',
        // )
        // ->join('tbl_wallet', 'tbl_users.id', '=', 'tbl_wallet.user_id')
        // ->join('tbl_cryptocurrencies', 'tbl_wallet.crypto_id', '=', 'tbl_cryptocurrencies.id')
        // ->where('tbl_users.username', $username)
        // ->get();
    }
}
