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

            $table->string('name', 200);
            $table->string('mobile', 200);
            $table->string('phone', 200);
            $table->string('town', 200);
            $table->string('postal_code', 200);
            $table->string('address_line_1', 200);
            $table->string('address_line_2', 200);
            $table->string('street', 200);
            $table->string('longitude', 200);
            $table->string('latitude', 200);

            $table->uuid('address_type_id');
            $table->uuid('country_id');

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
