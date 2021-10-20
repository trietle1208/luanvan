<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMangXaHoi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mangxahoi', function (Blueprint $table) {
            $table->id('mxh_id');
            $table->string('provider_kh_id');
            $table->string('provider');
            $table->integer('kh_id');
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
        Schema::table('mangxahoi', function (Blueprint $table) {
            //
        });
    }
}
