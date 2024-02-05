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

    public function getRateExchange($currency)
    {
        $result =  Exchange_Rate::select(
                    'tbl_currency.code',
                    'tbl_exchange_rate.to_rate'
                )
                ->join('tbl_currency', 'tbl_exchange_rate.to_currency_id', '=', 'tbl_currency.id')
                ->where('tbl_currency.code', $currency)
                ->first();

        return !empty($result) ? $result : [
                    'code'      => "USD",
                    'to_rate'   => NULL
                ];
    }
}
