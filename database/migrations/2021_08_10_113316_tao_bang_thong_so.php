<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaoBangThongSo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thongso', function (Blueprint $table) {
            $table->id('ts_id');
            $table->string('ts_tenthongso',50);
            $table->bigInteger('loaisp_id')->unsigned()->nullable();
            $table->foreign('loaisp_id')->references('loaisp_id')->on('loaisanpham')->onDelete('cascade');
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
        Schema::table('thongso', function (Blueprint $table) {
            //
        });
    }
}
