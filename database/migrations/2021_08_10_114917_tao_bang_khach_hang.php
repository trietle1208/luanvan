<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaoBangKhachHang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('khachhang', function (Blueprint $table) {
            $table->id('kh_id');
            $table->string('kh_hovaten',50);
            $table->string('kh_email');
            $table->string('kh_matkhau');
            $table->string('kh_sdt',20);
            $table->date('kh_ngaysinh');
            $table->boolean('kh_gioitinh')->comment('0 : nam ; 1 : nu');
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
        Schema::table('khachhang', function (Blueprint $table) {
            //
        });
    }
}
