<?php

namespace Database\Seeders;

use App\Models\User_Payment_Type;
use Illuminate\Database\Seeder;

class CreateUserPaymentType extends Seeder
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
                'user_id'           => 1,
                'payment_type_id'   => 1,
            ],
            [
                'user_id'           => 1,
                'payment_type_id'   => 2,
            ],
            [
                'user_id'           => 1,
                'payment_type_id'   => 3,
            ],
            [
                'user_id'           => 2,
                'payment_type_id'   => 2,
            ],
            [
                'user_id'           => 2,
                'payment_type_id'   => 3,
            ],
            [
                'user_id'           => 3,
                'payment_type_id'   => 1,
            ],
            [
                'user_id'           => 3,
                'payment_type_id'   => 3,
            ],
        ];

        foreach ($data as $value) {
            User_Payment_Type::create([
                'user_id'           => $value['user_id'],
                'payment_type_id'   => $value['payment_type_id'],
            ]);
        }
    }
}
