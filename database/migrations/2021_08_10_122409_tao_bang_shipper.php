<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaoBangShipper extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipper', function (Blueprint $table) {
            $table->id('gh_id');
            $table->string('gh_hovaten',50);
            $table->string('gh_email');
            $table->string('gh_matkhau');
            $table->string('gh_sdt',20);
            $table->date('gh_ngaysinh');
            $table->boolean('gh_gioitinh')->comment('0 : nam ; 1 : nu');
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
        Schema::table('shipper', function (Blueprint $table) {
            //
        });
    }
}
