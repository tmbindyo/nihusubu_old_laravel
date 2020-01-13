<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountAdjustmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_adjustments', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('reference');
            $table->longText('notes')->nullable();

            $table->decimal('amount',20,2);
            $table->decimal('initial_account_amount',20,2);
            $table->decimal('subsequent_account_amount',20,2);

            $table->date('date');

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('account_id');
            $table->uuid('institution_id');
            $table->boolean('is_deposit');
            $table->uuid('deposit_id')->nullable();
            $table->boolean('is_withdrawal');
            $table->uuid('withdrawal_id')->nullable();

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
        Schema::dropIfExists('account_adjustments');
    }
}
