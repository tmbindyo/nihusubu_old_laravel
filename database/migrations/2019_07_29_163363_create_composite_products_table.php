<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompositeProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('composite_products', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name', 200);
            $table->longText('description')->nullable();
            $table->string('stock_keeping_unit', 200)->nullable();
            $table->string('dimensions', 200)->nullable();
            $table->string('weight', 200)->nullable();
            $table->double('selling_price', 20,2);
            $table->double('manufacturing_price', 20,2)->nullable();
            $table->integer('opening_stock')->nullable();
            $table->double('opening_stock_value', 20,2)->nullable();
            $table->double('reorder_level', 20,2)->nullable();

            $table->integer('user_id')->unsigned();
            $table->uuid('selling_account_id');
            $table->uuid('purchase_account_id');
            $table->uuid('unit_id')->nullable();
            $table->uuid('manufacturer_id')->nullable();
            $table->uuid('brand_id')->nullable();
            $table->uuid('status_id');
            $table->uuid('institution_id');
            $table->uuid('tax_id')->nullable();
            $table->uuid('inventory_account_id')->nullable();
            $table->uuid('preferred_vendor_id')->nullable();
            $table->uuid('product_group_id')->nullable();

            $table->integer('manufacturing_time');

            $table->boolean('is_service');
            $table->boolean('is_returnable');
            $table->boolean('is_product_group');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('composite_products');
    }
}
