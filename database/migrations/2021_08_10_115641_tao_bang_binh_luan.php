<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaoBangBinhLuan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('binhluan', function (Blueprint $table) {
            $table->id('bl_id');
            $table->text('bl_noidung');
            $table->integer('bl_sosao');
            $table->integer('bl_idcha')->nullable();
            $table->bigInteger('sp_id')->unsigned()->nullable();
            $table->bigInteger('kh_id')->unsigned()->nullable();
            $table->bigInteger('us_id')->unsigned()->nullable();
            $table->foreign('sp_id')->references('sp_id')->on('sanpham');
            $table->foreign('kh_id')->references('kh_id')->on('khachhang');
            $table->foreign('us_id')->references('id')->on('users');
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
        Schema::table('binhluan', function (Blueprint $table) {
            //
        });
    }
}
