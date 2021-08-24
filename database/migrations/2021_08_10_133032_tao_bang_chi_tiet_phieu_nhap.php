<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaoBangChiTietPhieuNhap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietphieunhap', function (Blueprint $table) {
            $table->id('ctpn_id');
            $table->bigInteger('sp_id')->unsigned();
            $table->bigInteger('pnh_id')->unsigned();
            $table->integer('soluong');
            $table->float('giagoc');
            $table->timestamps();
            $table->foreign('sp_id')->references('sp_id')->on('sanpham');
            $table->foreign('pnh_id')->references('pnh_id')->on('phieunhaphang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chitietphieunhap', function (Blueprint $table) {
            //
        });
    }
}
