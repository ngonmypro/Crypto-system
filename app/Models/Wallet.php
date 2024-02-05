<?php

namespace App\Models;

use App\Domain\WalletDomain;
use App\Enums\Person;
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

    public function createDefaultWalletNewUser($defaultWallet)
    {
        Wallet::insert($defaultWallet);
    }

    public function checkBalanceSellCryptoByUser($cryptoId, $userId)
    {
        return  Wallet::select(
                    'balance',
                    'id'
                )
                ->where([
                    'user_id'       => $userId,
                    'crypto_id'     => $cryptoId
                    ])
                ->first();
    }

    public function confirmTransferCrypto($userId, $walletId, $cryptoId, $cryptoAmount, $personTransfer)
    {
        $resultBalance = self::checkBalanceSellCryptoByUser($cryptoId, $userId);
        $calBalance = WalletDomain::calWalletBalance($resultBalance->balance, $cryptoAmount, $personTransfer);

        Wallet::where([
            'user_id'   => $userId,
            'crypto_id' => $cryptoId,
            'id'        => $walletId ?? $walletId,
        ])
        ->update([
            'balance'   => $calBalance,
        ]);
    }
}
