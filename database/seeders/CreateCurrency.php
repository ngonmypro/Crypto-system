<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CreateCurrency extends Seeder
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
                'name'  => 'United States Dollar',
                'code'  => 'USD',
            ],
            [
                'name'  => 'Thai Baht',
                'code'  => 'THB',
            ],
            [
                'name'  => 'Japanese Yen',
                'code'  => 'JPY',
            ],
            [
                'name'  => 'Australian Dollar',
                'code'  => 'AUD',
            ],
        ];

        foreach ($data as $value) {
            Currency::create([
                'name'  => $value['name'],
                'code'  => $value['code'],
            ]);
        }
    }
}
