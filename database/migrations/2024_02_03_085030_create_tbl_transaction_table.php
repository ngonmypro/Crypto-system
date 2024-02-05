<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_transaction', function (Blueprint $table) {
            $table->id();
            $table->integer('sender_wallet_id')->index();
            $table->integer('receiver_wallet_id')->index()->nullable();
            $table->string('address');
            $table->float('amount', 20, 10);
            $table->integer('crypto_id')->index();
            $table->integer('type_id')->index()->nullable();
            $table->integer('payment_id')->index()->nullable();
            $table->integer('status_id')->index();
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
        Schema::dropIfExists('tbl_transaction');
    }
}
