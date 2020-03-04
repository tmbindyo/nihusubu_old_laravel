<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('invoice_number');
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

            $table->uuid('customer_id')->nullable();
            $table->uuid('project_id')->nullable();
            $table->uuid('estimate_id')->nullable();
            $table->uuid('institution_id')->nullable();
            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');

            $table->boolean('is_returned');
            $table->boolean('is_refunded');
            $table->boolean('is_product');
            $table->boolean('is_project');
            $table->boolean('has_uploads');
            $table->boolean('was_estimate');

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
        Schema::dropIfExists('invoices');
    }
}
