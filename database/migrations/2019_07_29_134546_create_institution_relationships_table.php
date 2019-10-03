<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutionRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institution_relationships', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('parent_id');
            $table->uuid('child_id');
            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');

            $table->boolean('is_partnership');
            // todo Find a way to handle for partnerships to collaborate

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
        Schema::dropIfExists('institution_relationships');
    }
}
