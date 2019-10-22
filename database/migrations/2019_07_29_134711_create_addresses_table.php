<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('attention', 200)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('phone_number', 200)->nullable();
            $table->string('town', 200)->nullable();
            $table->string('po_box', 200)->nullable();
            $table->string('postal_code', 200)->nullable();
            $table->string('address_line_1', 200)->nullable();
            $table->string('address_line_2', 200)->nullable();
            $table->string('street', 200)->nullable();
            $table->string('longitude', 200)->nullable();
            $table->string('latitude', 200)->nullable();

            $table->uuid('address_type_id');
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
        Schema::dropIfExists('addresses');
    }
}
