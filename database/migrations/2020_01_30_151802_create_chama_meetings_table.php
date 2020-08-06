<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChamaMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chama_meetings', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('location', 200);
            $table->string('description', 200);
            $table->longText('minutes');

            $table->date('start_date');
            $table->date('end_date');

            $table->date('date');
            $table->longText('agenda')->nullable();
            $table->boolean('is_scheduled');

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
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
        Schema::dropIfExists('chama_meetings');
    }
}
