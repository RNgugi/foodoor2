<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBankDetailsToRestaurants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->string('bank_name')->nullable();
            $table->string('bank_ifsc')->nullable();
            $table->string('bank_acc_no')->nullable();
            $table->string('bank_acc_name')->nullable();
            $table->integer('bank_acc_type')->default(1);
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
            $table->dropColumn('bank_name');
            $table->dropColumn('bank_ifsc');
            $table->dropColumn('bank_acc_no');
            $table->dropColumn('bank_acc_name');
           // $table->dropColumn('bank_acc_type');
        });
    }
}
