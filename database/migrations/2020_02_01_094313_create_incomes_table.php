<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('reference', 200);

            $table->string('name', 200);
            $table->longText('description');

            $table->date('date');
            $table->date('end_date')->nullable();

            $table->decimal('amount', 20,2);

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('income_type_id');
            $table->uuid('account_id');

            $table->boolean('is_variable');
            $table->boolean('is_debit');

            $table->boolean('is_recurring');
            $table->uuid('frequency_id')->nullable();

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
        Schema::dropIfExists('incomes');
    }
}
