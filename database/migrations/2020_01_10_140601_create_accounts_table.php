<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->longText('notes')->nullable();
            $table->string('reference', 200);
            $table->string('name', 200);
            $table->decimal('balance',20,2);
            $table->decimal('goal',20,2)->nullable();

            $table->boolean('is_user');
            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->boolean('is_institution');
            $table->uuid('institution_id')->nullable();
            $table->boolean('is_chama');
            $table->uuid('chama_id')->nullable();

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
        Schema::dropIfExists('accounts');
    }
}
