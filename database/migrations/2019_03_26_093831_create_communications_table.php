<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description');
            $table->integer('communication_type_id')->unsigned();
            // $table->foreign('communication_type_id')->references('id')->on('communication_types');
            $table->integer('recipient_id')->unsigned();
            // $table->foreign('recipient_id')->references('id')->on('users')->nullable();
            $table->integer('sender_id')->unsigned();
            // $table->foreign('sender_id')->references('id')->on('users')->nullable();
            $table->integer('user_id')->unsigned();
            // $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('communications');
    }
}
