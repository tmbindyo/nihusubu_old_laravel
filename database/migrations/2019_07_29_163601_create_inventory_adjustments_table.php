<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryAdjustmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_adjustments', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('inventory_adjustment_number')->unique();
            $table->text('description');

            $table->boolean('is_value_adjustment');

            $table->uuid('reason_id');
            $table->uuid('warehouse_id');
            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('account_id')->nullable();

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
        Schema::dropIfExists('inventory_adjustments');
    }
}
