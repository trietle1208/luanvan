<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaoBangXaPhuong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xaphuong', function (Blueprint $table) {
            $table->id('xp_id');
            $table->string('xp_ten');
            $table->string('xp_loai');
            $table->bigInteger('qh_id')->unsigned()->nullable();
            $table->foreign('qh_id')->references('qh_id')->on('quanhuyen')->onDelete('cascade');
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
        Schema::table('xaphuong', function (Blueprint $table) {
            //
        });
    }
}
