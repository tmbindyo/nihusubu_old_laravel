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

            $table->string('inventory_adjustment_number');
            $table->text('reason');
            $table->text('description');
            $table->date('date');

            $table->uuid('account_id');
            $table->uuid('source_warehouse_id');
            $table->uuid('destination_warehouse_id');

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
        Schema::dropIfExists('inventory_adjustments');
    }
}
