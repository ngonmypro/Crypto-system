<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table 		= 	'tbl_payment';
	protected $primaryKey 	=	'id';
    protected $fillable = [
        'user_id',
        'order_id',
        'type_id',
        'payment_type_id',
        'paid_amount',
        'order_amount',
        'status_id',
    ];

    protected $hidden = [

    ];

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }

    public function status()
    {
        return $this->belongsToMany(Status::class);
    }

    public function createPaymentPaidOrder($request, $userId, $paymentTypeId, $typeId)
    {
        return  Payment::create([
                    'user_id'           => $userId,
                    'order_id'          => $request['order'],
                    'type_id'           => $typeId,
                    'payment_type_id'   => $paymentTypeId,
                    'paid_amount'       => $request['paidAmount'],
                    'order_amount'      => $request['orderAmount'],
                    'status_id'         => 1,
                ]);
    }

    public function getPaymentByUsernameAndPaymentId($request)
    {
        return  Payment::select(
                    'tbl_payment.id',
                )
                ->join('tbl_order', 'tbl_payment.order_id', '=', 'tbl_order.id')
                ->join('tbl_users', 'tbl_order.user_id', '=', 'tbl_users.id')
                ->where([
                    'tbl_payment.id'        => $request['payment'],
                    'tbl_users.username'    => $request['username']
                ])
                ->first();
    }

    public function confirmAcceptPayment($paymentId, $status)
    {
        Payment::where('id', $paymentId)
            ->update([
                'status_id' => $status
            ]);
    }
}
