<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaoBangChiTietDonHangMoi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietdonhang', function (Blueprint $table) {
            $table->id('ctdh_id');
            $table->bigInteger('dhncc_id')->unsigned();
            $table->bigInteger('sp_id')->unsigned();
            $table->float('gia');
            $table->boolean('soluong');
            $table->timestamps();
            $table->foreign('dhncc_id')->references('dhncc_id')->on('donhangncc');
            $table->foreign('sp_id')->references('sp_id')->on('sanpham');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
