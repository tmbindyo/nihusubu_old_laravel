<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_products', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->double('rate', 20,2);
            $table->double('quantity', 20,2);
            $table->double('amount', 20,2);
            $table->double('refund_amount', 20,2)->nullable();

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('sale_id');
            $table->uuid('product_id');
            $table->uuid('warehouse_id')->nullable();

            $table->boolean('is_product');
            $table->boolean('is_returned');
            $table->boolean('is_refunded');

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
        Schema::dropIfExists('sale_products');
    }
}
