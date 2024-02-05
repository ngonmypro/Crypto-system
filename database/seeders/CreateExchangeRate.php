<?php

namespace Database\Seeders;

use App\Models\Exchange_Rate;
use Illuminate\Database\Seeder;

class CreateExchangeRate extends Seeder
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
                'from_currency_id'  => '1',
                'to_currency_id'    => '2',
                'to_rate'           => '35.44',
            ],
            [
                'from_currency_id'  => '1',
                'to_currency_id'    => '3',
                'to_rate'           => '148.38',
            ],
            [
                'from_currency_id'  => '1',
                'to_currency_id'    => '4',
                'to_rate'           => '1.53',
            ],
        ];

        foreach ($data as $value) {
            Exchange_Rate::create([
                'from_currency_id'  => $value['from_currency_id'],
                'to_currency_id'    => $value['to_currency_id'],
                'to_rate'           => $value['to_rate'],
            ]);
        }
    }
}
