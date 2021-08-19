<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaoBangDonHang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donhang', function (Blueprint $table) {
            $table->id('dh_id');
            $table->string('dh_madonhang',50);
            $table->float('dh_tongtien');
            $table->integer('dh_trangthai')->default(0)->comment('0 : chua duyet ; 1 : xac nhan ; 2 : dang giao ; 3 : da nhan hang ; 4 : huy don');
            $table->timestamp('dh_thoigiandathang');
            $table->date('dh_thoigiangiaohang')->nullable();
            $table->date('dh_thoigiannhanhang')->nullable();
            $table->bigInteger('ht_id')->unsigned()->nullable();
            $table->bigInteger('dc_id')->unsigned()->nullable();
            $table->bigInteger('mgg_id')->unsigned()->nullable();
            $table->bigInteger('gh_id')->unsigned()->nullable();
            $table->foreign('ht_id')->references('ht_id')->on('hinhthucthanhtoan');
            $table->foreign('dc_id')->references('dc_id')->on('diachi');
            $table->foreign('mgg_id')->references('mgg_id')->on('magiamgia');
            $table->foreign('gh_id')->references('gh_id')->on('shipper');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('donhang', function (Blueprint $table) {
            //
        });
    }
}
