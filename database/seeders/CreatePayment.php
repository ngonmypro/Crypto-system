<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class CreatePayment extends Seeder
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
                'user_id'           => '',
                'order_id'          => '',
                'type_id'           => '',
                'payment_type_id'   => '',
                'paid_amount'       => '',
                'order_amount'      => '',
                'status_id'         => '',
            ],
            [
                'user_id'           => '',
                'order_id'          => '',
                'type_id'           => '',
                'payment_type_id'   => '',
                'paid_amount'       => '',
                'order_amount'      => '',
                'status_id'         => '',
            ],
            [
                'user_id'           => '',
                'order_id'          => '',
                'type_id'           => '',
                'payment_type_id'   => '',
                'paid_amount'       => '',
                'order_amount'      => '',
                'status_id'         => '',
            ],
            [
                'user_id'           => '',
                'order_id'          => '',
                'type_id'           => '',
                'payment_type_id'   => '',
                'paid_amount'       => '',
                'order_amount'      => '',
                'status_id'         => '',
            ],
        ];

        foreach ($data as $key => $value) {
            Payment::create([
                'user_id'           => $value[''],
                'order_id'          => $value[''],
                'type_id'           => $value[''],
                'payment_type_id'   => $value[''],
                'paid_amount'       => $value[''],
                'order_amount'      => $value[''],
                'status_id'         => $value[''],
            ]);
        }
    }
}
