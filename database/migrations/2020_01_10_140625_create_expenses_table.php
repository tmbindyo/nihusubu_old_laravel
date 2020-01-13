<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('reference');
            $table->longText('notes');

            $table->double('sub_total',20,2);
            $table->double('adjustment',20,2);
            $table->double('total',20,2);
            $table->double('paid',20,2);

            $table->date('date');
            $table->date('start_repeat')->nullable();
            $table->date('end_repeat')->nullable();

            $table->boolean('has_items')->nullable();

            $table->boolean('is_product');
            $table->uuid('product_id')->nullable();
            $table->boolean('is_composite_product');
            $table->uuid('composite_product_id')->nullable();
            $table->boolean('is_inventory_adjustment');
            $table->uuid('inventory_adjustment_id')->nullable();
            $table->boolean('is_transfer_order');
            $table->uuid('transfer_order_id')->nullable();
            $table->boolean('is_warehouse');
            $table->uuid('warehouse_id')->nullable();
            $table->boolean('is_campaign');
            $table->uuid('campaign_id')->nullable();
            $table->boolean('is_sale');
            $table->uuid('sale_id')->nullable();

            $table->boolean('is_draft');
            $table->boolean('is_recurring');

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('expense_account_id');
            $table->uuid('institution_id');
            $table->uuid('frequency_id')->nullable();

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
        Schema::dropIfExists('expenses');
    }
}
