<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaoBangChiTietBac extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietbac', function (Blueprint $table) {
            $table->bigInteger('kh_id')->unsigned();
            $table->bigInteger('bkh_id')->unsigned();
            $table->string('tong')->nullable();
            $table->date('ngaythangbac')->nullable();
            $table->primary(['kh_id','bkh_id']);
            $table->timestamps();
            $table->foreign('kh_id')->references('kh_id')->on('khachhang')->onDelete('cascade');
            $table->foreign('bkh_id')->references('bkh_id')->on('backhachhang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chitietbac', function (Blueprint $table) {
            //
        });
    }
}
