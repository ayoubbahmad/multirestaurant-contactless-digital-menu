<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFaviconToApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->text("fav_icon")->nullable();
            $table->text("qrcode_img")->nullable();
            $table->text("mobile_img")->nullable();
            $table->boolean('is_playstore_enable')->default(1);
            $table->text("playstore_link")->nullable();
            $table->boolean('is_review_enable')->default(1);
            $table->boolean('is_how_its_work_enable')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            //
        });
    }
}
