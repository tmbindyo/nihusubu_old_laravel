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
            $table->string('kra_pin_number', 200)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('phone_number', 200)->nullable();
            $table->string('website', 200)->nullable();
            $table->string('location', 200)->nullable();
            $table->date('inventory_start_date')->nullable();

            $table->uuid('logo_id')->nullable();
            $table->uuid('address_id')->nullable();
            $table->uuid('currency_id');
            $table->uuid('fiscal_year_id')->nullable();
            $table->uuid('language_id')->nullable();
            $table->uuid('timezone_id')->nullable();
            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('primary_contact_id')->nullable();

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
