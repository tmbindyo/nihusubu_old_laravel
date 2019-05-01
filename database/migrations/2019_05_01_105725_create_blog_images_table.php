<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('slug')->unique();
            $table->string('featured_image')->nullable();
            $table->string('wall_image')->nullable();
            $table->string('col_left')->nullable();
            $table->string('col_right')->nullable();
            $table->string('bottom_left')->nullable();
            $table->string('bottom_middle')->nullable();
            $table->string('bottom_right')->nullable();
            $table->integer('blog_id')->index();
            $table->integer('user_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_images');
    }
}
