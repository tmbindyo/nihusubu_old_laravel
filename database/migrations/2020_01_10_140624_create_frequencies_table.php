<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrequenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frequencies', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name');
            $table->string('type');
            $table->integer('frequency');

            $table->integer('user_id')->unsigned();
            $table->uuid('institution_id')->nullable();
            $table->boolean('is_institution');
            $table->boolean('is_user');
            $table->uuid('status_id')->default('c670f7a2-b6d1-4669-8ab5-9c764a1e403e');

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
        Schema::dropIfExists('frequencies');
    }
}
