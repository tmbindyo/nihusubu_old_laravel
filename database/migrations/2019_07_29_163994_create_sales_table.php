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

            $table->string('reference');
            $table->text('customer_notes')->nullable();
            $table->longText('terms_and_conditions')->nullable();
            $table->date('date');
            $table->date('due_date');

            $table->double('subtotal', 20,2);
            $table->double('discount', 20,2);
            $table->double('tax', 20,2);
            $table->double('total', 20,2);
            $table->double('paid', 20,2);
            $table->double('balance', 20,2);
            $table->double('refund', 20,2)->nullable();

            $table->uuid('customer_id')->nullable();
            $table->uuid('project_id')->nullable();
            $table->uuid('institution_id');
            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');

            $table->boolean('is_sample');
            $table->boolean('is_returned');
            $table->boolean('is_refunded');
            $table->boolean('is_product');
            $table->boolean('is_project');
            $table->boolean('has_uploads');
            $table->boolean('is_draft');

            $table->boolean('is_estimate');
            $table->boolean('is_invoice');
            $table->boolean('is_order');
            $table->boolean('is_sale');

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
