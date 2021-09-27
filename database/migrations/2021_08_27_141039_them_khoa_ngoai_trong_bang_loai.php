<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ThemKhoaNgoaiTrongBangLoai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loaisanpham', function (Blueprint $table) {
            $table->bigInteger('dm_id')->unsigned()->nullable();
            $table->foreign('dm_id')->references('dm_id')->on('danhmuc');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('loaisanpham', function (Blueprint $table) {
            //
        });
    }
}
