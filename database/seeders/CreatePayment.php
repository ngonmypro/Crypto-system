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
                'user_id'           => '3',
                'order_id'          => '5',
                'type_id'           => '1',
                'payment_type_id'   => '2',
                'paid_amount'       => '1.21500',
                'order_amount'      => '15',
                'status_id'         => '3',
            ],
            [
                'user_id'           => '1',
                'order_id'          => '3',
                'type_id'           => '1',
                'payment_type_id'   => '3',
                'paid_amount'       => '2157',
                'order_amount'      => '0.05',
                'status_id'         => '3',
            ],
        ];

        foreach ($data as $value) {
            Payment::create([
                'user_id'           => $value['user_id'],
                'order_id'          => $value['order_id'],
                'type_id'           => $value['type_id'],
                'payment_type_id'   => $value['payment_type_id'],
                'paid_amount'       => $value['paid_amount'],
                'order_amount'      => $value['order_amount'],
                'status_id'         => $value['status_id'],
            ]);
        }
    }
}
