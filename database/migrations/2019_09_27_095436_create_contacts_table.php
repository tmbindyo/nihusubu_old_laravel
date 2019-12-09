<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->double('opening_balance',20,2);
            $table->double('balance',20,2);

            $table->string('company_name', 200);
            $table->string('first_name', 200);
            $table->string('last_name', 200);
            $table->string('display_name', 200)->nullable();
            $table->string('email', 200);
            $table->string('phone_number', 200);
            $table->string('website', 200);

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('salutation_id');
            $table->uuid('currency_id')->nullable();
            $table->uuid('payment_term_id');
            $table->uuid('institution_id');
            $table->uuid('shipping_address_id');
            $table->uuid('billing_address_id');

            $table->boolean('is_customer');// or vendor
            $table->boolean('is_business');// or individual

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
        Schema::dropIfExists('contacts');
    }
}
