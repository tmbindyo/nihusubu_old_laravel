<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransferOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_orders', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('transfer_order_number');
            $table->text('reason');
            $table->date('date');

            $table->uuid('source_warehouse_id');
            $table->uuid('destination_warehouse_id');

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
        Schema::dropIfExists('transfer_orders');
    }
}
