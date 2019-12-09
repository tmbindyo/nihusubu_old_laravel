<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstimateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimate_products', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->double('rate', 20,2);
            $table->double('quantity', 20,2);
            $table->double('amount', 20,2);

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('estimate_id');
            $table->uuid('product_id');
            $table->uuid('warehouse_id')->nullable();

            $table->boolean('is_product');

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
        Schema::dropIfExists('estimate_products');
    }
}
