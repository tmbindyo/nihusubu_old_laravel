<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_emails', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('to', 200);
            $table->string('subject', 200);
            $table->text('body');

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('sale_id');

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
        Schema::dropIfExists('sale_emails');
    }
}
