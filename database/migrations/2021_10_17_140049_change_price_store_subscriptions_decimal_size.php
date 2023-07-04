<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePriceStoreSubscriptionsDecimalSize extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('store_subscriptions', function (Blueprint $table) {
            $table->float('price','12','4')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('store_subscriptions', function (Blueprint $table) {
            $table->float('price','12','4')->change();
        });
    }
}
