<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaoBangDiaChi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diachi', function (Blueprint $table) {
            $table->id('dc_id');
            $table->string('dc_sonha',50);
            $table->string('dc_tennguoinhan',50);
            $table->string('dc_sdt',20);
            $table->bigInteger('kh_id')->unsigned()->nullable();
            $table->bigInteger('qh_id')->unsigned()->nullable();
            $table->foreign('kh_id')->references('kh_id')->on('khachhang')->onDelete('cascade');
            $table->foreign('qh_id')->references('qh_id')->on('quanhuyen');
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
        Schema::table('diachi', function (Blueprint $table) {
            //
        });
    }
}
