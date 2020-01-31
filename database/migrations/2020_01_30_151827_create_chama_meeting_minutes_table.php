<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChamaMeetingMinutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chama_meeting_minutes', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('location', 200);
            $table->longText('minutes');

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('meeting_id');
            $table->uuid('chama_id');

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
        Schema::dropIfExists('chama_meeting_minutes');
    }
}
