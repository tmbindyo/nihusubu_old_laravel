<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompositeItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('composite_items', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name', 200);
            $table->longText('description');
            $table->string('stock_keeping_unit', 200);

            $table->string('dimensions', 200)->nullable();
            $table->string('weight', 200)->nullable();

            $table->double('selling_price', 20,2);
            $table->double('purchase_price', 20,2);

            $table->uuid('item_type_id');
            $table->uuid('unit_id');
            $table->uuid('manufacturer_id')->nullable();
            $table->uuid('brand_id')->nullable();
            $table->uuid('file_id')->nullable();
            $table->uuid('selling_price_account_id')->nullable();
            $table->uuid('purchase_price_account_id')->nullable();
            $table->uuid('item_group_id')->nullable();

            $table->boolean('is_returnable');
            $table->boolean('is_item_group');

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
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
        Schema::dropIfExists('composite_items');
    }
}
