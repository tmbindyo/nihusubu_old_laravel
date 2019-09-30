<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('estimate_number');
            $table->string('reference_number');
            $table->text('customer_notes');
            $table->text('terms_and_conditions');
            $table->date('date');
            $table->date('expiry_date');
            $table->date('due_date');

            $table->double('subtotal', 20,2);
            $table->double('discount', 20,2);
            $table->double('adjustment', 20,2);
            $table->double('total', 20,2);
            $table->double('refund', 20,2);
            $table->double('adjustment_value', 20,2);

            $table->uuid('delivery_method_id');
            $table->uuid('discount_type_id')->nullable();
            $table->uuid('customer_id')->nullable();
            $table->uuid('template_id')->nullable();
            $table->uuid('project_id')->nullable();

            $table->boolean('is_returned');
            $table->boolean('is_refunded');
            $table->boolean('is_product');
            $table->boolean('is_project');
            $table->boolean('has_uploads');
            $table->boolean('is_paid');
            $table->boolean('is_cleared');
            $table->uuid('institution_id');

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
        Schema::dropIfExists('orders');
    }
}
