<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaoBangMaGiamGia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magiamgia', function (Blueprint $table) {
            $table->id('mgg_id');
            $table->string('mgg_macode',50);
            $table->text('mgg_mota');
            $table->boolean('mgg_hinhthuc')->comment('0 : giam theo tien ; 1 : giam theo %');
            $table->float('mgg_sotiengiam');
            $table->integer('mgg_soluong');
            $table->bigInteger('ncc_id')->unsigned()->nullable();
            $table->foreign('ncc_id')->references('ncc_id')->on('nhacungcap');
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
        Schema::table('magiamgia', function (Blueprint $table) {
            //
        });
    }
}
