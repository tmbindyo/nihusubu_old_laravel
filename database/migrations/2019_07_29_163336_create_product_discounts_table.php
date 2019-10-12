<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_discounts', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->integer('quantity');
            $table->double('discount');

            $table->date('start_date');
            $table->date('end_date');

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('product_id');

            $table->boolean('is_percentage');

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
        Schema::dropIfExists('product_discounts');
    }
}
