<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMilestonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('milestones', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name');
            $table->string('milestone_flag'); // todo Check what this was
            $table->longText('description');
            $table->double('budget',20,2);

            $table->date('start_date');
            $table->date('end_date');

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('project_id');
            $table->uuid('assignee_id');

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
        Schema::dropIfExists('milestones');
    }
}
