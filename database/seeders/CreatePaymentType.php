<?php

namespace Database\Seeders;

use App\Models\Payment_Type;
use Illuminate\Database\Seeder;

class CreatePaymentType extends Seeder
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
                'name'  => 'BANK TRANSFER',
            ],
            [
                'name'  => 'LINE PAY',
            ],
            [
                'name'  => 'THAI QR',
            ],
        ];

        foreach ($data as $value) {
            Payment_Type::create([
                'name'  => $value['name'],
            ]);
        }
    }
}
