<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaoBangDonHangNcc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donhangncc', function (Blueprint $table) {
            $table->id('dhncc_id');
            $table->bigInteger('dh_id')->unsigned();
            $table->bigInteger('ncc_id')->unsigned();
            $table->bigInteger('mgg_id')->unsigned();
            $table->float('tongtien');
            $table->boolean('trangthai');
            $table->timestamps();
            $table->foreign('dh_id')->references('dh_id')->on('donhang');
            $table->foreign('ncc_id')->references('ncc_id')->on('nhacungcap');
            $table->foreign('mgg_id')->references('mgg_id')->on('magiamgia');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
