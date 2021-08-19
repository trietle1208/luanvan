<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaoBangSanPham extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanpham', function (Blueprint $table) {
            $table->id('sp_id');
            $table->string('sp_ten',50);
            $table->string('sp_slug',150);
            $table->float('sp_giabanra');
            $table->integer('sp_soluong');
            $table->text('sp_mota');
            $table->text('sp_chitiet');
            $table->float('sp_thoigianbaohanh');
            $table->boolean('sp_trangthai')->default(0)->comment('0: chua duyet ; 1 : da duyet');
            $table->bigInteger('ncc_id')->unsigned()->nullable();
            $table->bigInteger('th_id')->unsigned()->nullable();
            $table->bigInteger('dm_id')->unsigned()->nullable();
            $table->bigInteger('km_id')->unsigned()->nullable();
            $table->foreign('ncc_id')->references('ncc_id')->on('nhacungcap')->onDelete('cascade');
            $table->foreign('th_id')->references('th_id')->on('thuonghieu');
            $table->foreign('dm_id')->references('dm_id')->on('danhmuc');
            $table->foreign('km_id')->references('km_id')->on('khuyenmai');
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
        Schema::table('sanpham', function (Blueprint $table) {
            //
        });
    }
}
