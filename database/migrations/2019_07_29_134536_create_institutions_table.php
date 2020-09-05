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
            $table->string('sale_format', 200)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('phone_number', 200)->nullable();
            $table->string('website', 200)->nullable();
            $table->string('location', 200)->nullable();
            $table->date('inventory_start_date')->nullable();
            $table->string('kra')->nullable();

            $table->string('instagram', 200)->nullable();
            $table->string('facebook', 200)->nullable();
            $table->string('twitter', 200)->nullable();

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('plan_id');
            $table->uuid('logo_id')->nullable();
            $table->uuid('address_id')->nullable();
            $table->uuid('currency_id');
            $table->uuid('fiscal_year_id')->nullable();
            $table->uuid('language_id')->nullable();
            $table->uuid('timezone_id')->nullable();
            $table->uuid('primary_contact_id')->nullable();
            $table->uuid('commerce_template_id')->nullable();

            $table->boolean('is_active');
            $table->boolean('is_sale_tax');
            $table->boolean('is_sale_random');

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
