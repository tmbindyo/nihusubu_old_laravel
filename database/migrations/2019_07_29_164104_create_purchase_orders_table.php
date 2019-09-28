<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            // todo figure out where to put expense settings

            $table->uuid('id')->primary();

            $table->string('name', 200)->nullable();

            $table->double('amount',5,2);
            $table->double('amount_approved',5,2);

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('currency_id');
            $table->uuid('tax_id');

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
        Schema::dropIfExists('purchase_orders');
    }
}
