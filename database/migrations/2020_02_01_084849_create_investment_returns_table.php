<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestmentReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investment_returns', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->longText('reason');

            $table->decimal('amount',20,2);

            $table->date('date');

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('chama_id');
            $table->uuid('investment_id');

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
        Schema::dropIfExists('investment_returns');
    }
}
