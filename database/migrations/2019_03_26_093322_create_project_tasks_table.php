<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('priority');
            $table->string('name');
            $table->longText('description');
            $table->double('total_budget', 8, 2);
            $table->double('used_budget', 8, 2);
            $table->double('remaining_budget', 8, 2);
            $table->integer('project_id')->unsigned();
            // $table->foreign('project_id')->references('id')->on('projects');
            $table->integer('assignee_id')->unsigned();
            // $table->foreign('assignee_id')->references('id')->on('users');
            $table->integer('status_id')->unsigned();
            // $table->foreign('status_id')->references('id')->on('statuses');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('user_id')->unsigned();
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
        Schema::dropIfExists('project_tasks');
    }
}
