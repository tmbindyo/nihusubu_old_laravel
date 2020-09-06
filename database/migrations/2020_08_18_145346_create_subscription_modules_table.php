<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_modules', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->double('amount',9,2);

            $table->integer('month');
            $table->integer('year');

            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->date('last_updated')->nullable();

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('institution_id');
            $table->uuid('module_id');
            $table->uuid('subscription_id');
            $table->uuid('institution_module_id');

            $table->boolean('is_active');

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
        Schema::dropIfExists('subscription_modules');
    }
}
