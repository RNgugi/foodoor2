<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeletesToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restaurants', function (Blueprint $table) {
             $table->softDeletes();
        });
        
        Schema::table('orders', function (Blueprint $table) {
             $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
             $table->softDeletes();
        });

        Schema::table('items', function (Blueprint $table) {
             $table->softDeletes();
        });

        Schema::table('cuisines', function (Blueprint $table) {
             $table->softDeletes();
        });

        Schema::table('cities', function (Blueprint $table) {
             $table->softDeletes();
        });

        Schema::table('drivers', function (Blueprint $table) {
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
        Schema::table('restaurants', function (Blueprint $table) {
            //
        });
    }
}
