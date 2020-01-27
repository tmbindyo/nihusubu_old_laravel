<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenseAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_accounts', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name');
            $table->string('code');
            $table->longText('description');

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('account_type_id');
            $table->uuid('institution_id');
            $table->boolean('is_institution');
            $table->boolean('is_user');

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
        Schema::dropIfExists('expense_accounts');
    }
}
