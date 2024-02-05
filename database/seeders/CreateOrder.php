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
            // [
            //     'user_id'           => '2',
            //     'crypto_id'         => '2',
            //     'type_id'           => '1',
            //     'status_id'         => '1',
            //     'limit_amount'      => '',
            //     'min_amount'        => '',
            //     'balance_amount'    => '',
            //     'price'             => '2305',
            // ],
            // [
            //     'user_id'           => '2',
            //     'crypto_id'         => '3',
            //     'type_id'           => '1',
            //     'status_id'         => '1',
            //     'limit_amount'      => '',
            //     'min_amount'        => '',
            //     'balance_amount'    => '',
            //     'price'             => '0.5',
            // ],
            // [
            //     'user_id'           => '2',
            //     'crypto_id'         => '4',
            //     'type_id'           => '1',
            //     'status_id'         => '1',
            //     'limit_amount'      => '',
            //     'min_amount'        => '',
            //     'balance_amount'    => '',
            //     'price'             => '0.075',
            // ],
            // [
            //     'user_id'           => '2',
            //     'crypto_id'         => '5',
            //     'type_id'           => '1',
            //     'status_id'         => '1',
            //     'limit_amount'      => '',
            //     'min_amount'        => '',
            //     'balance_amount'    => '',
            //     'price'             => '300.88',
            // ],
        ];

        foreach ($data as $key => $value) {
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
