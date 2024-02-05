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
                'sender_wallet_id'      => '9',
                'receiver_wallet_id'    => '14',
                'address'               => 'nguan_buyer|DOGE',
                'amount'                => '15',
                'crypto_id'             => '4',
                'type_id'               => '1',
                'payment_id'            => '8',
                'status_id'             => '3',
            ],
            [
                'sender_wallet_id'      => '11',
                'receiver_wallet_id'    => NULL,
                'address'               => 'Addres_out_system|BTC',
                'amount'                => '0.2',
                'crypto_id'             => '1',
                'type_id'               => NULL,
                'payment_id'            => NULL,
                'status_id'             => '3',
            ],
            [
                'sender_wallet_id'      => '6',
                'receiver_wallet_id'    => '1',
                'address'               => 'nguan_admin|BTC',
                'amount'                => '0.05',
                'crypto_id'             => '1',
                'type_id'               => '1',
                'payment_id'            => '9',
                'status_id'             => '3',
            ],
        ];

        foreach ($data as $value) {
            Transaction::create([
                'sender_wallet_id'      => $value['sender_wallet_id'],
                'receiver_wallet_id'    => $value['receiver_wallet_id'],
                'address'               => $value['address'],
                'amount'                => $value['amount'],
                'crypto_id'             => $value['crypto_id'],
                'type_id'               => $value['type_id'],
                'payment_id'            => $value['payment_id'],
                'status_id'             => $value['status_id'],
            ]);
        }
    }
}
