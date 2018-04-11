<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeChangesToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->text('delivery_address')->change();
            $table->double('delivery_charges');
            $table->double('tax');
            $table->double('subtotal');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('delivery_address')->change();
            $table->dropColumn('delivery_charges');
            $table->dropColumn('tax');
            $table->dropColumn('subtotal');
        });
    }
}
