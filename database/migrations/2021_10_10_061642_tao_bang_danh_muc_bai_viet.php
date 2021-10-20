<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaoBangDanhMucBaiViet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('danhmucbaiviet', function (Blueprint $table) {
            $table->id('dmbv_id');
            $table->string('dmbv_ten',50);
            $table->text('dmbv_mota');
            $table->string('dm_slug',150)->nullable();
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
        Schema::table('danhmucbaiviet', function (Blueprint $table) {
            //
        });
    }
}
