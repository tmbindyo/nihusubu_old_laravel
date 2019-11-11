<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompositeProductProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('composite_product_products', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->integer('quantity');
            $table->double('unit_price',20,2);
            $table->double('total_price',20,2);

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('product_id');
            $table->uuid('composite_product_id');

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
        Schema::dropIfExists('composite_product_products');
    }
}
