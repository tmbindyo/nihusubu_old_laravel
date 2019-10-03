<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimesheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timesheets', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->date('date');
            $table->longText('notes');
            $table->integer('hours');
            $table->time('start_time');
            $table->time('end_time');

            $table->integer('user_id')->unsigned();
            $table->integer('approved_by')->unsigned();
            $table->uuid('status_id');
            $table->uuid('task_id');
            $table->uuid('issue_id');

            $table->boolean('is_billable');
            $table->boolean('is_task');
            $table->boolean('is_issue');
            $table->boolean('is_approved');

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
        Schema::dropIfExists('timesheets');
    }
}
