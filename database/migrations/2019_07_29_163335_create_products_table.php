<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name', 200);
            $table->longText('description')->nullable();
            $table->string('stock_keeping_unit', 200)->nullable();
            $table->string('dimensions', 200)->nullable();
            $table->string('weight', 200)->nullable();
            $table->double('selling_price', 20,2);
            $table->double('purchase_price', 20,2);
            $table->double('manufacturing_price', 20,2)->nullable();
            $table->integer('opening_stock')->nullable();
            $table->double('opening_stock_value', 20,2)->nullable();
            $table->double('reorder_level', 20,2)->nullable();
            $table->integer('creation_time')->nullable();
            $table->integer('creation_cost')->nullable();

            $table->integer('user_id')->unsigned();
            $table->uuid('selling_account_id');
            $table->uuid('purchase_account_id');
            $table->uuid('unit_id')->nullable();
            $table->uuid('status_id');
            $table->uuid('institution_id');
            $table->uuid('inventory_account_id')->nullable();
            $table->uuid('preferred_vendor_id')->nullable();
            $table->uuid('product_group_id')->nullable();

            $table->boolean('is_service');
            $table->boolean('is_created');
            $table->boolean('is_returnable');
            $table->boolean('is_product_group');

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
        Schema::dropIfExists('products');
    }
}

