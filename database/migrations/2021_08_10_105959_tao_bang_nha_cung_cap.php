<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaoBangNhaCungCap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhacungcap', function (Blueprint $table) {
            $table->id('ncc_id');
            $table->string('ncc_ten',50);
            $table->string('ncc_diachi')->unique();
            $table->string('ncc_sdt',20);
            $table->text('ncc_mota');
            $table->string('ncc_hinhanh')->nullable();
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
        Schema::table('nhacungcap', function (Blueprint $table) {
            //
        });
    }
}
