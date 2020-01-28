<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToDosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('to_dos', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name');
            $table->text('notes');

            $table->date('start_date');
            $table->integer('start_year');
            $table->integer('start_month');
            $table->integer('start_day');
            $table->time('start_time');
            $table->integer('start_hour');
            $table->integer('start_minute');

            $table->boolean('is_end_date');
            $table->date('end_date')->nullable();
            $table->integer('end_year')->nullable();
            $table->integer('end_month')->nullable();
            $table->integer('end_day')->nullable();

            $table->boolean('is_end_time');
            $table->time('end_time')->nullable();
            $table->integer('end_hour')->nullable();
            $table->integer('end_minute')->nullable();

            $table->boolean('is_completed');
            $table->date('date_completed')->nullable();

            $table->integer('user_id')->unsigned();
            $table->boolean('is_assignee');
            $table->integer('assignee_id')->unsigned()->nullable();
            $table->uuid('status_id');
            $table->boolean('is_institution');
            $table->uuid('institution_id');
            $table->boolean('is_user');

            $table->boolean('is_product');
            $table->uuid('product_id')->nullable();
            $table->boolean('is_product_group');
            $table->uuid('product_group_id')->nullable();
            $table->boolean('is_warehouse');
            $table->uuid('warehouse_id')->nullable();
            $table->boolean('is_sale');
            $table->uuid('sale_id')->nullable();
            $table->boolean('is_contact');
            $table->uuid('contact_id')->nullable();
            $table->boolean('is_organization');
            $table->uuid('organization_id')->nullable();
            $table->boolean('is_campaign');
            $table->uuid('campaign_id')->nullable();

            $table->boolean('is_account');
            $table->uuid('account_id')->nullable();
            $table->boolean('is_account_adjustment');
            $table->uuid('account_adjustment_id')->nullable();
            $table->boolean('is_deposit');
            $table->uuid('deposit_id')->nullable();
            $table->boolean('is_liability');
            $table->uuid('liability_id')->nullable();
            $table->boolean('is_loan');
            $table->uuid('loan_id')->nullable();
            $table->boolean('is_withdrawal');
            $table->uuid('withdrawal_id')->nullable();
            $table->boolean('is_expense');
            $table->uuid('expense_id')->nullable();
            $table->boolean('is_payment');
            $table->uuid('payment_id')->nullable();
            $table->boolean('is_refund');
            $table->uuid('refund_id')->nullable();
            $table->boolean('is_transaction');
            $table->uuid('transaction_id')->nullable();
            $table->boolean('is_transfer');
            $table->uuid('transfer_id')->nullable();

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
        Schema::dropIfExists('to_dos');
    }
}
