<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            CreateUser::class,
            CreateType::class,
            CreateStatus::class,
            CreateCurrency::class,
            CreateCryptocurrencies::class,
            CreatePaymentType::class,
            CreateExchangeRate::class,
            CreateWallet::class,
            CreateUserPaymentType::class,
            CreateOrder::class,
            CreatePayment::class,
            CreateTransaction::class,
        ]);
    }
}
