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
}
