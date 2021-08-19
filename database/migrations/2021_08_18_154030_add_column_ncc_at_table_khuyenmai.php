<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnNccAtTableKhuyenmai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('khuyenmai', function (Blueprint $table) {
            $table->bigInteger('ncc_id')->unsigned();
            $table->foreign('ncc_id')->references('ncc_id')->on('nhacungcap');
            $table->softDeletes();
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
            $table->dropColumn('deleted_at');
            $table->dropColumn('ncc_id');
        });
    }
}
