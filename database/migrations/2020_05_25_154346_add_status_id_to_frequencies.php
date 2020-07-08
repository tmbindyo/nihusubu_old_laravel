<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusIdToFrequencies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('frequencies', function (Blueprint $table) {
            $table->uuid('status_id')->default('c670f7a2-b6d1-4669-8ab5-9c764a1e403e');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('frequencies', function (Blueprint $table) {
            $table->dropColumn(['status_id']);
        });
    }
}
