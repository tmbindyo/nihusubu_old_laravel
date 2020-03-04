<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxes', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name', 200)->nullable();
            $table->double('amount',5,2);

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('institution_id')->nullable();

            $table->boolean('is_percentage');

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
        Schema::dropIfExists('taxes');
    }
}
