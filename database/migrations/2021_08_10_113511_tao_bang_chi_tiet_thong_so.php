<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaoBangChiTietThongSo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietthongso', function (Blueprint $table) {
            $table->id('chitiet_id');
            $table->bigInteger('sp_id')->unsigned();
            $table->bigInteger('ts_id')->unsigned();
            $table->string('chitietthongso');
            $table->timestamps();
            $table->foreign('sp_id')->references('sp_id')->on('sanpham')->onDelete('cascade');
            $table->foreign('ts_id')->references('ts_id')->on('thongso');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chitietthongso', function (Blueprint $table) {
            //
        });
    }
}
