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

            $table->uuid('sub_industry_id');
            $table->uuid('address_id');
            $table->uuid('primary_contact_id');
            $table->uuid('currency_id');
            $table->uuid('fiscal_year_id');
            $table->uuid('language_id');

            $table->integer('user_id')->unsigned();
            $table->uuid('status_type_id');
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
