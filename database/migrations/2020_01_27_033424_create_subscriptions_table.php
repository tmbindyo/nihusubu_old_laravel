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

            $table->boolean('is_user');
            $table->integer('user_id')->unsigned();
            $table->boolean('is_institution');
            $table->uuid('institution_id')->nullable();
            $table->uuid('status_id');
            $table->uuid('subscription_type_id');
            $table->uuid('plan_id');

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
