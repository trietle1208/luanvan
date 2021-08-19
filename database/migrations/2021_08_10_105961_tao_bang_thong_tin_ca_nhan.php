<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaoBangThongTinCaNhan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thongtincanhan', function (Blueprint $table) {
            $table->id('tt_id');
            $table->string('tt_diachi');
            $table->string('tt_sdt', 20);
            $table->boolean('tt_gioitinh')->comment('0: nam ; 1: nu');
            $table->date('tt_ngaysinh');
            $table->bigInteger('us_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('us_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('thongtincanhan', function (Blueprint $table) {
            //
        });
    }
}
