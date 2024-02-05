<?php

namespace Database\Seeders;

use App\Models\Wallet;
use Illuminate\Database\Seeder;

class CreateWallet extends Seeder
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
                'user_id'   => '1',
                'crypto_id' => '1',
                'balance'   => '5.15982',
                'address'   => 'nguan_admin|BTC',
            ],
            [
                'user_id'   => '1',
                'crypto_id' => '2',
                'balance'   => '91.1853022',
                'address'   => 'nguan_admin|ETH',
            ],
            [
                'user_id'   => '1',
                'crypto_id' => '3',
                'balance'   => '200',
                'address'   => 'nguan_admin|XRP',
            ],
            [
                'user_id'   => '1',
                'crypto_id' => '4',
                'balance'   => '1000',
                'address'   => 'nguan_admin|DOGE',
            ],
            [
                'user_id'   => '1',
                'crypto_id' => '5',
                'balance'   => '10',
                'address'   => 'nguan_admin|BNB',
            ],
            [
                'user_id'   => '2',
                'crypto_id' => '1',
                'balance'   => '2.4',
                'address'   => 'nguan_seller|BTC',
            ],
            [
                'user_id'   => '2',
                'crypto_id' => '2',
                'balance'   => '200.55',
                'address'   => 'nguan_seller|ETH',
            ],
            [
                'user_id'   => '2',
                'crypto_id' => '3',
                'balance'   => '5000.6',
                'address'   => 'nguan_seller|XRP',
            ],
            [
                'user_id'   => '2',
                'crypto_id' => '4',
                'balance'   => '520.99',
                'address'   => 'nguan_seller|DOGE',
            ],
            [
                'user_id'   => '2',
                'crypto_id' => '5',
                'balance'   => '40.565',
                'address'   => 'nguan_seller|BNB',
            ],
            [
                'user_id'   => '3',
                'crypto_id' => '1',
                'balance'   => '1.03',
                'address'   => 'nguan_buyer|BTC',
            ],
            [
                'user_id'   => '3',
                'crypto_id' => '2',
                'balance'   => '30.124',
                'address'   => 'nguan_buyer|ETH',
            ],
            [
                'user_id'   => '3',
                'crypto_id' => '3',
                'balance'   => '100',
                'address'   => 'nguan_buyer|XRP',
            ],
            [
                'user_id'   => '3',
                'crypto_id' => '4',
                'balance'   => '10.5',
                'address'   => 'nguan_buyer|DOGE',
            ],
            [
                'user_id'   => '3',
                'crypto_id' => '5',
                'balance'   => '2.1',
                'address'   => 'nguan_buyer|BNB',
            ],
        ];

        foreach ($data as $key => $value) {
            Wallet::create([
                'user_id'   => $value['user_id'],
                'crypto_id' => $value['crypto_id'],
                'balance'   => $value['balance'],
                'address'   => $value['address'],
            ]);
        }
    }
}
