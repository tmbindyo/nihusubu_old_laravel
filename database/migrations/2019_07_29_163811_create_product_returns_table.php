<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_returns', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->double('initial_warehouse_quantity',20,6)->nullable();
            $table->double('subsequent_warehouse_quantity',20,6)->nullable();
            $table->double('quantity',20,6)->nullable();

            $table->date('date');

            $table->uuid('product_id');
            $table->uuid('warehouse_id');
            $table->uuid('sale_id');

            $table->uuid('is_damaged');

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
        Schema::dropIfExists('product_returns');
    }
}
