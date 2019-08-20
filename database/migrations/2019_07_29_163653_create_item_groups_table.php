<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_groups', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->text('attribute');
            $table->text('option');

            $table->uuid('unit_id');
            $table->uuid('tax_id');
            $table->uuid('brand_id');
            $table->uuid('manufacturer_id');

            $table->boolean('is_returnable');

            $table->integer('user_id')->unsigned();
            $table->uuid('status_type_id');
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
        Schema::dropIfExists('item_groups');
    }
}
