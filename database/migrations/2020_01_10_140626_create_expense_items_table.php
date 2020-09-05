<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpenseItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_items', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name', 200)->nullable();
            $table->double('quantity',20,2);
            $table->double('rate',20,2);
            $table->double('amount',20,2);

            $table->integer('user_id')->unsigned();
            $table->uuid('expense_id');
            $table->uuid('status_id');
            $table->boolean('is_institution');
            $table->boolean('is_user');

            $table->boolean('is_product');
            $table->uuid('product_id')->nullable();
            $table->boolean('is_restock');
            $table->uuid('restock_id')->nullable();

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
        Schema::dropIfExists('expense_items');
    }
}
