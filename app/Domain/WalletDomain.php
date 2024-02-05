<?php

namespace App\Domain;

use App\Enums\Person;
use App\Models\Cryptocurrencies;

class WalletDomain
{
    public function setFormatWalletDefault($userDetail)
    {
        $resultCryptos = Cryptocurrencies::getCryptoList();

        $defaultWallets = [];
        foreach ($resultCryptos as $rowCrypto) {
            array_push($defaultWallets, [
                'user_id'       => $userDetail->lastId,
                'crypto_id'     => $rowCrypto->id,
                'balance'       => 0,
                'address'       => $userDetail->username.'|'.$rowCrypto->symbol,
                'created_at'    => NOW(),
                'updated_at'    => NOW(),
            ]);
        }

        return  $defaultWallets;
    }

    public function calWalletBalance($balance, $cryptoAmount, $personTransfer)
    {
        return $personTransfer == Person::SENDER ? $balance - $cryptoAmount : $balance + $cryptoAmount;
    }
}
