<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ThemKhoaNgoaiNccIdVaoBangShipper extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipper', function (Blueprint $table) {
            $table->bigInteger('ncc_id')->unsigned()->nullable();
            $table->foreign('ncc_id')->references('ncc_id')->on('nhacungcap');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
