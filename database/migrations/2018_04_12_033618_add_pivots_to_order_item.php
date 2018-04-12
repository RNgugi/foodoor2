<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPivotsToOrderItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_item', function (Blueprint $table) {
            $table->text('option')->nullable();
            $table->text('size')->nullable();
            $table->double('price');
            $table->integer('qty');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_item', function (Blueprint $table) {
            $table->dropColumn('option');
            $table->dropColumn('size');
            $table->dropColumn('price');
            $table->dropColumn('qty');
        });
    }
}
