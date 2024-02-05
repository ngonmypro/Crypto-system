<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment_Type extends Model
{
    protected $table 		= 	'tbl_payment_type';
	protected $primaryKey 	=	'id';
    protected $fillable = [
        'name',
    ];

    protected $hidden = [

    ];

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function user_payment_type()
    {
        return $this->hasMany(User_Payment_Type::class);
    }

    public function getPaymentTypeByOwnerOrder($paymentMethod, $userId)
    {
        return  Payment_Type::select(
                    'tbl_payment_type.id'
                )
                ->join('tbl_user_payment_type', 'tbl_payment_type.id', '=', 'tbl_user_payment_type.payment_type_id')
                ->where([
                    'tbl_user_payment_type.user_id' => $userId,
                    'tbl_payment_type.name' => $paymentMethod
                ])
                ->first();
    }
}
