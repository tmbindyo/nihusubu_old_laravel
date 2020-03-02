<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNameNamePhoneNumberEmailToChamaMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chama_members', function (Blueprint $table) {
            $table->string('name');
            $table->string('phone_number');
            $table->string('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chama_members', function (Blueprint $table) {
            $table->dropColumn(['name','phone_number','email']);
        });
    }
}
