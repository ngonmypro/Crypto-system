<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table 		= 	'tbl_wallet';
	protected $primaryKey 	=	'id';
    protected $fillable = [
        'user_id',
        'crypto_id',
        'balance',
        'address',
    ];

    protected $hidden = [

    ];

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }

    public function createDefaultWalletNewUser($userDetail)
    {
        $resultCryptos = Cryptocurrencies::getCryptoList();

        $defaultWallet = [];
        foreach ($resultCryptos as $rowCrypto) {
            array_push($defaultWallet, [
                'user_id'       => $userDetail->lastId,
                'crypto_id'     => $rowCrypto->id,
                'balance'       => 0,
                'address'       => $userDetail->username.'|'.$rowCrypto->symbol,
                'created_at'    => NOW(),
                'updated_at'    => NOW(),
            ]);
        }

        Wallet::insert($defaultWallet);
    }
}
