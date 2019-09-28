<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name', 200);
            $table->longText('description');
            $table->integer('severity');

            $table->date('start_date');
            $table->date('end_date');

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('project_id');
            $table->uuid('milestone_id');
            $table->uuid('task_id');
            $table->uuid('reporter_id');
            $table->uuid('assignee_id');

            $table->boolean('is_milestone');
            $table->boolean('is_task');
            $table->boolean('has_uploads');

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
        Schema::dropIfExists('issues');
    }
}
