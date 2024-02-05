<?php

namespace App\Domain;

class TransactionDomain
{
    public function setFormatTransactionTransferCrypto($paymentDetail, $receiverDetail, $senderDetail)
    {
        return  [
                    'sender_wallet_id'      => $senderDetail['wallet_id'],
                    'receiver_wallet_id'    => $receiverDetail['wallet_id'] ?? NULL,
                    'address'               => $receiverDetail['address'] ?? NULL,
                    'amount'                => $paymentDetail['order_amount'],
                    'crypto_id'             => $senderDetail['crypto_id'],
                    'type_id'               => $paymentDetail['type_id'] ?? NULL,
                    'payment_id'            => $paymentDetail['id'] ?? NULL,
                    'status_id'             => $senderDetail['status_id'] ?? 1,
                    'created_at'            => NOW(),
                    'updated_at'            => NOW(),
                ];
    }

    public function setDataTransferCrypto($verifyWallet, $cryptoId, $requestTransfer)
    {
        $paymentDetail  = [
            'order_amount'  => $requestTransfer['transferAmount'],
        ];

        $receiverDetail = [
            'address'   => $requestTransfer['address'],
        ];

        $senderDetail   = [
            'wallet_id' => $verifyWallet['wallet_id'],
            'crypto_id' => $cryptoId,
            'status_id' => 2,
        ];

        return self::setFormatTransactionTransferCrypto($paymentDetail, $receiverDetail, $senderDetail);
    }
}
