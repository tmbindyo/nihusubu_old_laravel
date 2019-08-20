<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryAdjustmentItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_adjustment_items', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('inventory_adjustment_number');
            $table->double('initial_warehouse_amount',20,6);
            $table->double('quantity',20,6);
            $table->double('subsequent_warehouse_amount',20,6);
            $table->date('date');

            $table->uuid('item_id');

            $table->integer('user_id')->unsigned();
            $table->uuid('status_type_id');
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
        Schema::dropIfExists('inventory_adjustment_items');
    }
}
