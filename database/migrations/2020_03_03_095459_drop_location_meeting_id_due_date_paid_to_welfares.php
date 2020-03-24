<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropLocationMeetingIdDueDatePaidToWelfares extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('welfares', function (Blueprint $table) {
            $table->dropColumn('location');
            $table->dropColumn('paid');
            $table->dropColumn('due_date');
            $table->dropColumn('meeting_id');
            $table->dropColumn('member_id');
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
            //
        });
    }
}
