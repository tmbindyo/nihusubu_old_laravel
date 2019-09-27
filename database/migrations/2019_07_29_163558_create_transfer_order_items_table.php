<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransferOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_order_items', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('transfer_order_number');
            $table->double('initial_warehouse_amount',20,6);
            $table->double('quantity',20,6);
            $table->double('subsequent_warehouse_amount',20,6);
            $table->date('date');

            $table->uuid('item_id');

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
        Schema::dropIfExists('transfer_order_items');
    }
}
