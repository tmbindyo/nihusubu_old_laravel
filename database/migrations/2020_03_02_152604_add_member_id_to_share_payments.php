<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMemberIdToSharePayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shares_payments', function (Blueprint $table) {
            $table->uuid('member_id');
            $table->uuid('account_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shares_payments', function (Blueprint $table) {
            $table->dropColumn(['member_id', 'account_id']);
        });
    }
}
