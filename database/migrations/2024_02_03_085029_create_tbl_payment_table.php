<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_payment', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->index();
            $table->integer('order_id')->index();
            $table->integer('type_id')->index();
            $table->integer('payment_type_id')->index();
            $table->float('paid_amount', 15, 5)->comment('Stamp paid USD');
            $table->float('order_amount', 20, 10);
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
        Schema::dropIfExists('tbl_payment');
    }
}
