<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaoBangPhieuNhapHang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieunhaphang', function (Blueprint $table) {
            $table->id('pnh_id');
            $table->string('pnh_ten',50);
            $table->float('pnh_tongcong');
            $table->boolean('pnh_trangthai')->default(0)->comment('0 : chua duyet ; 1 : da duyet');
            $table->date('pnh_ngayduyet')->nullable();
            $table->bigInteger('ncc_id')->unsigned()->nullable();
            $table->bigInteger('nguoilapphieu_id')->unsigned()->nullable();
            $table->bigInteger('nguoiduyet_id')->unsigned()->nullable();
            $table->foreign('ncc_id')->references('ncc_id')->on('nhacungcap');
            $table->foreign('nguoilapphieu_id')->references('id')->on('users');
            $table->foreign('nguoiduyet_id')->references('id')->on('users');
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
        Schema::table('phieunhaphanh', function (Blueprint $table) {
            //
        });
    }
}
