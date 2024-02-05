<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCryptocurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_cryptocurrencies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('symbol', 5)->index();
            $table->float('current_price', 15, 5)->index()->comment('Rate exchange crypto 1 coin to USD');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_cryptocurrencies');
    }
}
