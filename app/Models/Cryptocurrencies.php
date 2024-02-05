<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cryptocurrencies extends Model
{
    protected $table 		= 	'tbl_cryptocurrencies';
	protected $primaryKey 	=	'id';
    protected $fillable = [
        'name',
        'symbol',
        'current_price',
    ];

    protected $hidden = [

    ];

    public function wallet()
    {
        return $this->hasMany(Wallet::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getCryptoList()
    {
        return Cryptocurrencies::select('id', 'symbol')->get();
    }
}
