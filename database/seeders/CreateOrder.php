<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class CreateOrder extends Seeder
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
                'user_id'           => '2',
                'crypto_id'         => '1',
                'type_id'           => '1',
                'status_id'         => '1',
                'limit_amount'      => '1.2',
                'min_amount'        => '0.00035',
                'balance_amount'    => '1.2',
                'price'             => '43130',
            ],
            [
                'user_id'           => '2',
                'crypto_id'         => '1',
                'type_id'           => '1',
                'status_id'         => '1',
                'limit_amount'      => '1.2000000000',
                'min_amount'        => '0.0003500000',
                'balance_amount'    => '1.2000000000',
                'price'             => '43130',
            ],
            [
                'user_id'           => '2',
                'crypto_id'         => '1',
                'type_id'           => '2',
                'status_id'         => '1',
                'limit_amount'      => '1.2000000000',
                'min_amount'        => '0.0003500000',
                'balance_amount'    => '1.1500000000',
                'price'             => '43140',
            ],
            [
                'user_id'           => '2',
                'crypto_id'         => '2',
                'type_id'           => '1',
                'status_id'         => '1',
                'limit_amount'      => '20.4000000000',
                'min_amount'        => '0.2165440000',
                'balance_amount'    => '20.4000000000',
                'price'             => '2309',
            ],
            [
                'user_id'           => '2',
                'crypto_id'         => '4',
                'type_id'           => '2',
                'status_id'         => '1',
                'limit_amount'      => '200.1000000000',
                'min_amount'        => '15.0000000000',
                'balance_amount'    => '185.1000000000',
                'price'             => '0.08100',
            ],
        ];

        foreach ($data as $value) {
            Order::create([
                'user_id'           => $value['user_id'],
                'crypto_id'         => $value['crypto_id'],
                'type_id'           => $value['type_id'],
                'status_id'         => $value['status_id'],
                'limit_amount'      => $value['limit_amount'],
                'min_amount'        => $value['min_amount'],
                'balance_amount'    => $value['balance_amount'],
                'price'             => $value['price'],
            ]);
        }
    }
}
