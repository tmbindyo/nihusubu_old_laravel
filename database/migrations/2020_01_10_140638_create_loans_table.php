<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('reference');
            $table->longText('about');

            $table->decimal('total',20,2);
            $table->decimal('principal',20,2);
            $table->decimal('interest',20,8)->nullable();
            $table->decimal('interest_amount',20,8)->nullable();
            $table->decimal('paid',20,2)->nullable();
            $table->decimal('balance',20,2)->nullable();

            $table->date('date');
            $table->date('due_date');

            $table->boolean('is_user');
            $table->integer('user_id')->unsigned();
            $table->boolean('is_institution');
            $table->uuid('institution_id')->nullable();
            $table->boolean('is_chama');
            $table->uuid('chama_id')->nullable();
            $table->uuid('member_id')->nullable();
            $table->uuid('account_id')->nullable();
            $table->uuid('status_id');
            $table->uuid('contact_id')->nullable();
            $table->uuid('loan_type_id')->nullable();


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
        Schema::dropIfExists('loans');
    }
}
