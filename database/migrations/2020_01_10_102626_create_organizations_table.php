<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('reference');

            $table->string('name');
            $table->string('phone_number');
            $table->string('website');
            $table->string('email');

            $table->longText('description');

            $table->string('street');
            $table->string('city');

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->boolean('is_institution');
            $table->uuid('institution_id')->nullable();
            $table->boolean('is_chama');
            $table->uuid('chama_id')->nullable();
            $table->uuid('payment_schedule_id')->nullable();
            $table->uuid('campaign_id')->nullable();
            $table->uuid('parent_organization_id')->nullable();

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
        Schema::dropIfExists('organizations');
    }
}
