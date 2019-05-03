<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDomainIdToKingdoms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kingdoms', function (Blueprint $table) {
            //
            $table->integer('domain_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kingdoms', function (Blueprint $table) {
            //
            $table->integer('domain_id')->unsigned();
        });
    }
}
