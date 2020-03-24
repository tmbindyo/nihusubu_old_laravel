<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDateToChamaMeetings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chama_meetings', function (Blueprint $table) {
            $table->date('date');
            $table->longText('agenda')->nullable();
            $table->boolean('is_scheduled');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chama_meetings', function (Blueprint $table) {
            $table->dropColumn(['date','agenda','is_scheduled']);
        });
    }
}
