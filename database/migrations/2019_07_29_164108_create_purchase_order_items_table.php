<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_items', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name', 200)->nullable();
            $table->double('quantity',5,2);
            $table->double('rate',5,2);

            $table->integer('user_id')->unsigned();
            $table->uuid('purchase_order_id');
            $table->uuid('status_id');

            $table->boolean('is_rejected');
            $table->longText('reason_rejected');

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
        Schema::dropIfExists('purchase_order_items');
    }
}
