<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name', 200);

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('subscription_type_id');
            $table->uuid('plan_id');

            // institution
            $table->boolean('is_institution');
            $table->uuid('institution_id')->nullable();
            $table->boolean('is_user');
            $table->uuid('user_id')->nullable();

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
        Schema::dropIfExists('subscriptions');
    }
}
