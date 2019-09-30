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

            $table->string('company_name', 200);
            $table->string('primary_contact_first_name', 200);
            $table->string('primary_contact_last_name', 200);
            $table->string('contact_display_name', 200);
            $table->string('contact_email', 200);
            $table->string('contact_work_phone', 200);
            $table->string('contact_mobile', 200);
            $table->string('website', 200);

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('customer_type_id')->nullable();
            $table->uuid('contact_type_id');
            $table->uuid('salutation_id');
            $table->uuid('currency_id');
            $table->uuid('payment_term_id');
            $table->uuid('institution_id');

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
