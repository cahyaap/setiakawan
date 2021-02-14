<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRekapDataToDetailTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_transaksis', function (Blueprint $table) {
            $table->decimal('retur', 10, 2)->after('jenis')->nullable();
            $table->decimal('potongan', 10, 2)->after('retur')->nullable();
            $table->bigInteger('hpp')->after('potongan')->nullable();
            $table->decimal('lebih_kurang', 10, 2)->after('hpp')->nullable();
            $table->bigInteger('laba')->after('lebih_kurang')->nullable();
            $table->string('keterangan')->after('laba')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_transaksis', function (Blueprint $table) {
            //
        });
    }
}
