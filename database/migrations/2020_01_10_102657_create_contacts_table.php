<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('website')->nullable();
            $table->longText('about');

            // address
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();

            $table->boolean('is_user');
            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->boolean('is_institution');
            $table->uuid('institution_id')->nullable();
            $table->boolean('is_organization');
            $table->uuid('organization_id')->nullable();
            $table->uuid('title_id')->nullable();
            $table->uuid('lead_source_id')->nullable();
            $table->uuid('campaign_id')->nullable();

            $table->boolean('is_lead');

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
        Schema::dropIfExists('contacts');
    }
}
