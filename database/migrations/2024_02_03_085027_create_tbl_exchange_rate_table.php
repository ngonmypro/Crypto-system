<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblExchangeRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_exchange_rate', function (Blueprint $table) {
            $table->id();
            $table->integer('from_currency_id')->index();
            $table->integer('to_currency_id')->index();
            $table->float('to_rate', 15, 5);
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
        Schema::dropIfExists('tbl_exchange_rate');
    }
}
