<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAccountIdMemberIdToWelfares extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('welfares', function (Blueprint $table) {
            $table->uuid('member_id');
            $table->uuid('account_id');
            $table->longText('reason');
            $table->date('date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('welfares', function (Blueprint $table) {
            $table->dropColumn(['member_id','account_id','reason','date']);
        });
    }
}
