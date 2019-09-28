<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManualJournalAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manual_journal_accounts', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->double('initial_balance', 20,2);
            $table->double('new_balance', 20,2);
            $table->double('debit', 20,2);
            $table->double('credit', 20,2);

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('account_id');

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
        Schema::dropIfExists('manual_journal_accounts');
    }
}
