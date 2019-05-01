<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->unique();
            $table->string('name', 200);
            $table->longText('description');
            $table->string('location', 200);
            $table->string('latitude', 200);
            $table->string('longitude', 200);
            $table->integer('user_id')->unsigned();
            $table->integer('farm_size_id')->unsigned();
            $table->integer('age_cluster_id')->unsigned();
            $table->integer('family_size_id')->unsigned();
            $table->integer('sand_type_id')->unsigned();
            $table->integer('topography_id')->unsigned();
            $table->integer('gender_id')->unsigned();
            $table->integer('fertility_id')->unsigned();
            $table->integer('status_id')->unsigned();
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
        Schema::dropIfExists('farms');
    }
}
