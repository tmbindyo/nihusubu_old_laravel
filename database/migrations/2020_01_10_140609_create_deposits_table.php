<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('reference', 200);
            $table->longText('about');

            $table->date('date');

            $table->decimal('initial_amount',20,2);
            $table->decimal('amount',20,2);
            $table->decimal('subsequent_amount',20,2);

            $table->boolean('is_user');
            $table->integer('user_id')->unsigned();
            $table->boolean('is_institution');
            $table->uuid('institution_id')->nullable();
            $table->boolean('is_income');
            $table->uuid('income_id')->nullable();
            $table->uuid('status_id');
            $table->uuid('account_id');
            $table->boolean('is_chama');

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
        Schema::dropIfExists('deposits');
    }
}
