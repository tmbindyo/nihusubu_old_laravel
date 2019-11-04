<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryAdjustmentProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_adjustment_products', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('inventory_adjustment_number');

            $table->double('initial_quantity',20,6);
            $table->double('subsequent_quantity',20,6);
            $table->double('quantity',20,6);

            $table->uuid('inventory_adjustment_id');
            $table->uuid('product_id');
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
        Schema::dropIfExists('inventory_adjustment_products');
    }
}
