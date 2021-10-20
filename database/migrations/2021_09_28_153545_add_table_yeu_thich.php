<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableYeuThich extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yeuthich', function (Blueprint $table) {
            $table->id('id_yt');
            $table->bigInteger('kh_id')->unsigned()->nullable();;
            $table->bigInteger('sp_id')->unsigned()->nullable();;
            $table->foreign('kh_id')->references('kh_id')->on('khachhang')->onDelete('cascade');
            $table->foreign('sp_id')->references('sp_id')->on('sanpham')->onDelete('cascade');
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
        Schema::table('yeuthich', function (Blueprint $table) {
            //
        });
    }
}
