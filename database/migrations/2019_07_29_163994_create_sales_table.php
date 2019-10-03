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

            $table->string('estimate_number');
            $table->string('reference_number');
            $table->text('customer_notes');
            $table->text('terms_and_conditions');
            $table->date('date');
            $table->date('expiry_date');
            $table->date('due_date');
            $table->date('date_delivered');

            $table->double('subtotal', 20,2);
            $table->double('discount', 20,2);
            $table->double('adjustment', 20,2);
            $table->double('total', 20,2);
            $table->double('refund', 20,2);
            $table->double('adjustment_value', 20,2);

            $table->uuid('customer_id')->nullable();
            $table->uuid('project_id')->nullable();
            $table->uuid('invoice_id')->nullable();
            $table->uuid('institution_id');
            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');

            $table->boolean('is_returned');
            $table->boolean('is_refunded');
            $table->boolean('is_product');
            $table->boolean('is_project');
            $table->boolean('has_uploads');
            $table->boolean('is_paid');
            $table->boolean('is_cleared');
            $table->boolean('was_invoice');

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
