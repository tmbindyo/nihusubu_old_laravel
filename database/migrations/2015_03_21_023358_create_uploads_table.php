<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name', 200);
            $table->string('extension');
            $table->integer('size');
            $table->longText('image')->nullable();
            $table->longText('small_thumbnail')->nullable();
            $table->longText('large_thumbnail')->nullable();
            $table->longText('banner')->nullable();
            $table->longText('file')->nullable();
            $table->longText('original')->nullable();

            $table->string('file_type');

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('upload_type_id');
            $table->uuid('institution_id')->nullable();
            $table->uuid('campaign_id')->nullable();
            $table->uuid('feedback_id')->nullable();

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
        Schema::dropIfExists('uploads');
    }
}
