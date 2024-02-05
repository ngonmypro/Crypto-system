<?php

namespace Database\Seeders;

use App\Models\Cryptocurrencies;
use Illuminate\Database\Seeder;

class CreateCryptocurrencies extends Seeder
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
                'name'              => 'Bitcoin',
                'symbol'            => 'BTC',
                'current_price'     => '43131.05',
            ],
            [
                'name'              => 'Ethereum',
                'symbol'            => 'ETH',
                'current_price'     => '2307.11',
            ],
            [
                'name'              => 'XRP',
                'symbol'            => 'XRP',
                'current_price'     => '0.5191',
            ],
            [
                'name'              => 'Dogecoin',
                'symbol'            => 'DOGE',
                'current_price'     => '0.07923',
            ],
            [
                'name'              => 'BNB',
                'symbol'            => 'BNB',
                'current_price'     => '300.89',
            ],
        ];

        foreach ($data as $key => $value) {
            Cryptocurrencies::create([
                'name'          => $value['name'],
                'symbol'        => $value['symbol'],
                'current_price' => $value['current_price'],
            ]);
        }
    }
}
