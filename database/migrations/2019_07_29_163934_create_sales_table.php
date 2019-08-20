<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('order_number');
            $table->string('reference');
            $table->text('customer_notes');
            $table->text('terms_and_conditions');
            $table->date('date');

            $table->double('subtotal', 20,2);
            $table->double('discount', 20,2);
            $table->double('adjustment', 20,2);
            $table->double('total', 20,2);

            $table->uuid('warehouse_id');
            $table->uuid('sales_person_id');
            $table->uuid('delivery_method_id');
            $table->uuid('discount_type_id');
            $table->uuid('customer_id');

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
        Schema::dropIfExists('sales');
    }
}
