<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFreeDeliveryCoupons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freedeliveries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->text('promo_text')->nullable();
            $table->double('min_order');
            $table->string('valid_from');
            $table->string('valid_through');
            $table->integer('restaurant_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('freedeliveries');
    }
}
