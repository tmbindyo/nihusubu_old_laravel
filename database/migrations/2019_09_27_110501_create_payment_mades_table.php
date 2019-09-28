<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentMadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_mades', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->double('initial_balance', 20, 2)->nullable();
            $table->double('paid', 20, 2)->nullable();
            $table->double('current_balance', 20, 2)->nullable();

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('expense_id');

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
        Schema::dropIfExists('payment_mades');
    }
}
