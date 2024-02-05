<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;

class CreateTransaction extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'sender_wallet_id'      => '',
                'receiver_wallet_id'    => '',
                'address'               => '',
                'amount'                => '',
                'crypto_id'             => '',
                'type_id'               => '',
                'payment_id'            => '',
                'status_id'             => '',
            ],
            [
                'sender_wallet_id'      => '',
                'receiver_wallet_id'    => '',
                'address'               => '',
                'amount'                => '',
                'crypto_id'             => '',
                'type_id'               => '',
                'payment_id'            => '',
                'status_id'             => '',
            ],
            [
                'sender_wallet_id'      => '',
                'receiver_wallet_id'    => '',
                'address'               => '',
                'amount'                => '',
                'crypto_id'             => '',
                'type_id'               => '',
                'payment_id'            => '',
                'status_id'             => '',
            ],
            [
                'sender_wallet_id'      => '',
                'receiver_wallet_id'    => '',
                'address'               => '',
                'amount'                => '',
                'crypto_id'             => '',
                'type_id'               => '',
                'payment_id'            => '',
                'status_id'             => '',
            ],
            [
                'sender_wallet_id'      => '',
                'receiver_wallet_id'    => '',
                'address'               => '',
                'amount'                => '',
                'crypto_id'             => '',
                'type_id'               => '',
                'payment_id'            => '',
                'status_id'             => '',
            ],
        ];

        foreach ($data as $key => $value) {
            Transaction::create([
                'sender_wallet_id'      => $value[''],
                'receiver_wallet_id'    => $value[''],
                'address'               => $value[''],
                'amount'                => $value[''],
                'crypto_id'             => $value[''],
                'type_id'               => $value[''],
                'payment_id'            => $value[''],
                'status_id'             => $value[''],
            ]);
        }
    }
}
