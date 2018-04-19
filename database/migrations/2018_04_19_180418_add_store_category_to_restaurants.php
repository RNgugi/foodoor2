<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStoreCategoryToRestaurants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->integer('store_category')->default(0);
        });

        Schema::table('coupons', function (Blueprint $table) {
            $table->integer('store_category')->default(0);
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
            $table->dropColumn('store_category');
        });

         Schema::table('coupons', function (Blueprint $table) {
            $table->dropColumn('store_category');
        });
    }
}
