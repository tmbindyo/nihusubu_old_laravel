<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommerceTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commerce_templates', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name', 200);
            $table->text('base_url');
            $table->double('price', 20, 2);

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('commerce_template_type_id');

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
        Schema::dropIfExists('commerce_templates');
    }
}
