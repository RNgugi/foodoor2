<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOfferToRestaurants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->text('promo_text')->nullable();
            $table->integer('discount_type')->default(0);
            $table->double('discount')->nullable();
            $table->string('valid_from')->nullable();
            $table->string('valid_through')->nullable();
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
            $table->dropColumn('promo_text');
            $table->dropColumn('discount_type');
            $table->dropColumn('discount');
            $table->dropColumn('valid_from');
            $table->dropColumn('valid_through');
        });
    }
}
