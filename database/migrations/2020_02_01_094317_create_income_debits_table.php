<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomeDebitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_debits', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('reference', 200);

            $table->date('date');

            $table->decimal('amount', 20,2);

            $table->boolean('is_debited');

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('income_id');
            $table->uuid('account_id');

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
        Schema::dropIfExists('income_debits');
    }
}
