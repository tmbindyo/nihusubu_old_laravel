<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investments', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name');
            $table->longText('description');

            $table->decimal('total',20,2);
            $table->decimal('principal',20,2);
            $table->decimal('interest',20,8)->nullable();
            $table->decimal('interest_amount',20,8)->nullable();
            $table->decimal('returns',20,2)->nullable();

            $table->date('date');

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('chama_id');

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
        Schema::dropIfExists('investments');
    }
}
