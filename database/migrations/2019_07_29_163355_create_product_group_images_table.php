<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductGroupImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_group_images', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->integer('image_number');

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('product_group_id');
            $table->uuid('upload_id');

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
        Schema::dropIfExists('product_group_images');
    }
}
