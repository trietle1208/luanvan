<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaoBangKhuyenMai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('khuyenmai', function (Blueprint $table) {
            $table->id('km_id');
            $table->string('km_ten',50);
            $table->text('km_mota');
            $table->string('km_hinhanh')->nullable();
            $table->boolean('km_hinhthuc')->comment('0 : giam theo tien ; 1 : giam theo %');
            $table->float('km_giamgia');
            $table->boolean('km_trangthai')->comment('0 : chua duyet ; 1 : da duyet');
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
        Schema::table('khuyenmai', function (Blueprint $table) {
            //
        });
    }
}
