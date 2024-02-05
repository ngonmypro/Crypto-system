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
}
