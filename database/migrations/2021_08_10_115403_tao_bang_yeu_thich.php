<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaoBangYeuThich extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yeuthich', function (Blueprint $table) {
            $table->bigInteger('kh_id')->unsigned();
            $table->bigInteger('sp_id')->unsigned();
            $table->primary(['sp_id','kh_id'],'kh_sp_id');
            $table->timestamps();
            $table->foreign('sp_id')->references('sp_id')->on('sanpham')->onDelete('cascade');
            $table->foreign('kh_id')->references('kh_id')->on('khachhang')->onDelete('cascade');
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
