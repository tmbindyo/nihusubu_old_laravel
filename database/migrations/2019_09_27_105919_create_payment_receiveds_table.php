<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentReceivedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_receiveds', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->double('initial_balance', 20, 2)->nullable();
            $table->double('paid', 20, 2)->nullable();
            $table->double('current_balance', 20, 2)->nullable();

            $table->double('refunded', 20, 2)->nullable();

            $table->date('date');
            $table->date('date_refunded')->nullable();

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('sale_id');

            $table->boolean('is_refunded');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_receiveds');
    }
}
