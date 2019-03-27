<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_bids', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('description');
            $table->double('bid_amount', 8, 2);
            $table->integer('project_id')->unsigned();
            // $table->foreign('project_id')->references('id')->on('projects');
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
        Schema::dropIfExists('project_bids');
    }
}
