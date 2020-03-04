<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerryGoRoundContributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merry_go_round_contributions', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->decimal('amount',20,2);
            $table->date('date');

            $table->integer('user_id')->unsigned();
            $table->integer('member_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('chama_id');
            $table->uuid('merry_go_round_id');

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
        Schema::dropIfExists('merry_go_round_contributions');
    }
}
