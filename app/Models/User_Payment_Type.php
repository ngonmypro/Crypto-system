<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Payment_Type extends Model
{
    protected $table 		= 	'tbl_user_payment_type';
	protected $primaryKey 	=	'id';
    protected $fillable = [
        'user_id',
        'payment_type_id',
    ];

    protected $hidden = [

    ];
}
