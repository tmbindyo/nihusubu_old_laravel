<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('reference');
            $table->longText('notes')->nullable();

            $table->decimal('amount',20,2);
            $table->decimal('initial_amount',20,2)->nullable();
            $table->decimal('subsequent_amount',20,2)->nullable();

            $table->date('date');
            $table->date('billed')->nullable();

            $table->boolean('is_user');
            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('account_id')->nullable();
            $table->uuid('expense_id')->nullable();
            $table->boolean('is_institution');
            $table->uuid('institution_id')->nullable();
            $table->boolean('is_chama');
            $table->uuid('chama_id')->nullable();

            $table->boolean('is_billed')->nullable();
            $table->boolean('is_confirmed')->nullable();

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
        Schema::dropIfExists('transactions');
    }
}
