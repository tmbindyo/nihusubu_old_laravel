<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeletesMissing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phylum', function($table) {
            $table->softDeletes();
        });
    //     Schema::table('domains', function($table) {
    //         $table->softDeletes();
    //     });
    //     Schema::table('classes', function($table) {
    //         $table->softDeletes();
    //     });
    //     Schema::table('orders', function($table) {
    //         $table->softDeletes();
    //     });
    //     Schema::table('families', function($table) {
    //         $table->softDeletes();
    //     });
    //     Schema::table('genera', function($table) {
    //         $table->softDeletes();
    //     });
    //     Schema::table('species', function($table) {
    //         $table->softDeletes();
    //     });
    //     Schema::table('kingdoms', function($table) {
    //         $table->softDeletes();
    //     });
    //     Schema::table('roles', function($table) {
    //         $table->softDeletes();
    //     });
    //     Schema::table('institution_types', function($table) {
    //         $table->softDeletes();
    //     });
    //     Schema::table('menus', function($table) {
    //         $table->softDeletes();
    //     });
    //     Schema::table('features', function($table) {
    //         $table->softDeletes();
    //     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('domains', function($table) {
            $table->dropColumn();
        });
        Schema::table('orders', function($table) {
            $table->dropColumn();
        });
        Schema::table('families', function($table) {
            $table->dropColumn();
        });
        Schema::table('genera', function($table) {
            $table->dropColumn();
        });
        Schema::table('species', function($table) {
            $table->dropColumn();
        });
        Schema::table('kingdoms', function($table) {
            $table->dropColumn();
        });
        Schema::table('roles', function($table) {
            $table->dropColumn();
        });
        Schema::table('institution_types', function($table) {
            $table->dropColumn();
        });
        Schema::table('menus', function($table) {
            $table->dropColumn();
        });
        Schema::table('features', function($table) {
            $table->dropColumn();
        });
    }
}
