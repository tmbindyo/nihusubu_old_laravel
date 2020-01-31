<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_groups', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name', 200);
            $table->longText('description')->nullable();
            $table->longText('attributes')->nullable();
            $table->longText('attribute_options')->nullable();

            $table->integer('creation_time')->nullable();
            $table->integer('creation_cost')->nullable();

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('institution_id')->nullable();
            $table->uuid('unit_id');
            $table->uuid('selling_account_id');
            $table->uuid('purchase_account_id');
            $table->uuid('inventory_account_id');

            $table->boolean('is_service');
            $table->boolean('is_returnable');
            $table->boolean('is_created');

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
        Schema::dropIfExists('product_groups');
    }
}
