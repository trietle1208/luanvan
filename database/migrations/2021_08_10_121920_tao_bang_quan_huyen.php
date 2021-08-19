<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaoBangQuanHuyen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quanhuyen', function (Blueprint $table) {
            $table->id('qh_id');
            $table->string('qh_ten',50);
            $table->bigInteger('tp_id')->unsigned()->nullable();
            $table->foreign('tp_id')->references('tp_id')->on('thanhpho')->onDelete('cascade');
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
        Schema::table('quanhuyen', function (Blueprint $table) {
            //
        });
    }
}
