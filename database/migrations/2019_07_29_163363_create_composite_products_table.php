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

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('selling_account_id');
            $table->uuid('institution_id');
            $table->uuid('unit_id')->nullable();

            $table->uuid('manufacturer_id')->nullable();
            $table->uuid('brand_id')->nullable();
            $table->uuid('preferred_vendor_id')->nullable();

            $table->boolean('is_service');
            $table->boolean('is_returnable');

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
        Schema::dropIfExists('composite_products');
    }
}
