<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleUserTypeSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_user_type_sections', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_type_section_id');
            $table->uuid('role_id');
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
        Schema::dropIfExists('role_user_type_sections');
    }
}
