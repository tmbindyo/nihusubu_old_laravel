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
            $table->double('balance',20,2)->nullable();

            $table->date('date');
            $table->date('start_repeat')->nullable();
            $table->date('end_repeat')->nullable();

            $table->boolean('has_items')->nullable();

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
            $table->boolean('is_transfer');
            $table->uuid('transfer_id')->nullable();
            $table->boolean('is_transaction');
            $table->uuid('transaction_id')->nullable();

            $table->boolean('is_recurring');
            $table->boolean('is_restock');

            $table->boolean('is_user');
            $table->integer('user_id')->unsigned();
            $table->boolean('is_institution');
            $table->uuid('institution_id')->nullable();
            $table->uuid('status_id');
            $table->uuid('expense_account_id');
            $table->uuid('account_id');
            $table->uuid('frequency_id')->nullable();
            $table->uuid('payment_schedule_id')->nullable();

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
