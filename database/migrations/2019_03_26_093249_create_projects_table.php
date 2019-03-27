<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('return_rate');
            $table->string('name');
            $table->longText('description');
            $table->double('total_budget', 8, 2)->nullable();
            $table->double('used_budget', 8, 2)->nullable();
            $table->double('remaining_budget', 8, 2)->nullable();
            $table->integer('project_type_id')->unsigned();
            // $table->foreign('project_type_id')->references('id')->on('project_types');
            $table->integer('status_id')->unsigned();
            // $table->foreign('status_id')->references('id')->on('statuses');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('user_id')->unsigned()->nullable();
            // $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('projects');
    }
}
