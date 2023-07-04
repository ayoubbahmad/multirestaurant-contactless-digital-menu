<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreCategoriesStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_categories_stores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("store_category_id");
            $table->integer('store_id');
            $table->boolean("is_active")->default(1);
            $table->foreign('store_category_id')->references('id')->on('store_categories')->onDelete('cascade');
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
        Schema::dropIfExists('store_categories_stores');
    }
}
