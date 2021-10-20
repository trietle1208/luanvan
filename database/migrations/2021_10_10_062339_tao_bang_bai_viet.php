<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaoBangBaiViet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baiviet', function (Blueprint $table) {
            $table->id('bv_id');
            $table->bigInteger('dmbv_id')->unsigned()->nullable();
            $table->string('bv_ten',150);
            $table->text('bv_tomtat');
            $table->text('bv_noidung');
            $table->text('bv_hinhanh');
            $table->string('bv_slug',150)->nullable();
            $table->foreign('dmbv_id')->references('dmbv_id')->on('danhmucbaiviet')->onDelete('cascade');
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
        Schema::table('baiviet', function (Blueprint $table) {
            //
        });
    }
}
