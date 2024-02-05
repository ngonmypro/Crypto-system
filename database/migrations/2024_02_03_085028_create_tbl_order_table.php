<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_order', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index();
            $table->integer('crypto_id')->index();
            $table->integer('type_id')->index();
            $table->integer('status_id')->index();
            $table->float('limit_amount', 20, 10);
            $table->float('min_amount', 20, 10);
            $table->float('balance_amount', 20, 10);
            $table->float('price', 15, 5)->index()->comment('Stamp rate buy/sell USD');
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
        Schema::dropIfExists('tbl_order');
    }
}
