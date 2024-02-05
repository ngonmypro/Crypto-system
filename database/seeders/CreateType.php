<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class CreateType extends Seeder
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
                'name'  => 'BUY',
            ],
            [
                'name'  => 'SELL',
            ],
            [
                'name'  => 'WITHDRAW',
            ],
            [
                'name'  => 'DEPOSIT',
            ],
        ];

        foreach ($data as $key => $value) {
            Type::create([
                'name'  => $value['name'],
            ]);
        }
    }
}
