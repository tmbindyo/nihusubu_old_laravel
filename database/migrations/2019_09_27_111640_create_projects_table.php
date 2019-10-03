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
            $table->uuid('id')->primary();

            $table->string('name', 200);
            $table->longText('description');

            $table->double('budget',20,2);

            $table->date('start_date');
            $table->date('end_date');

            $table->integer('user_id')->unsigned();
            $table->integer('project_owner')->unsigned();
            $table->uuid('status_id');
            $table->uuid('customer_id');
            $table->uuid('institution_id');

            $table->uuid('is_customer');
            $table->boolean('is_public');
            $table->boolean('is_timesheet_billable');

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
