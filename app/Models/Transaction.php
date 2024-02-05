<?php

namespace App\Models;

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
}
