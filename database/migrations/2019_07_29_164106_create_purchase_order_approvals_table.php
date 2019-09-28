<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrderApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_approvals', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('purchase_order_id');
            $table->uuid('approver_id');

            $table->boolean('is_approved');

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
        Schema::dropIfExists('purchase_order_approvals');
    }
}
