<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaoBangBacKhachHang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('backhachhang', function (Blueprint $table) {
            $table->id('bkh_id');
            $table->string('bkh_loai',50);
            $table->float('bkh_dieukien');
            $table->text('bkh_chitietkhuyenmai');
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
        Schema::table('backhachhang', function (Blueprint $table) {
            //
        });
    }
}
