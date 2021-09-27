<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ThemCotTrongBangDiachi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diachi', function (Blueprint $table) {
            $table->bigInteger('xp_id')->unsigned();
            $table->foreign('xp_id')->references('xp_id')->on('xaphuong');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('diachi', function (Blueprint $table) {
            //
        });
    }
}
