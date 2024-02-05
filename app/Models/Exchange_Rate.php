<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exchange_Rate extends Model
{
    protected $table 		= 	'tbl_exchange_rate';
	protected $primaryKey 	=	'id';
    protected $fillable = [
        'from_currency_id',
        'to_currency_id',
        'to_rate',
    ];

    protected $hidden = [

    ];
}
