<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 200);
            $table->string('portal', 200);
            $table->longText('description');
            $table->string('kra_pin_number', 200);
            $table->string('website', 200);
            $table->string('location', 200);
            $table->date('inventory_start_date');

            $table->uuid('logo_id')->nullable();
            $table->uuid('primary_id')->nullable();
            $table->uuid('sub_industry_id')->nullable();
            $table->uuid('address_id');
            $table->uuid('primary_contact_id');
            $table->uuid('currency_id');
            $table->uuid('fiscal_year_id');
            $table->uuid('language_id');
            $table->uuid('timezone_id');

            $table->boolean('has_custom_payment_terms');

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
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
        Schema::dropIfExists('institutions');
    }
}
