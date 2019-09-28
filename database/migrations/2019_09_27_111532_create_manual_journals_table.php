<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManualJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manual_journals', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('journal_number', 200);
            $table->string('reference_number', 200);
            $table->longText('notes');
            $table->double('total', 20, 2);

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('currency_id');

            $table->boolean('is_cash_based_journal');

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
        Schema::dropIfExists('manual_journals');
    }
}
