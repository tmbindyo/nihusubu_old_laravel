<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChamaMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chama_members', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->decimal('shares', 20,2);

            $table->integer('user_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('chama_id');
            $table->uuid('member_role_id');

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
        Schema::dropIfExists('chama_members');
    }
}
