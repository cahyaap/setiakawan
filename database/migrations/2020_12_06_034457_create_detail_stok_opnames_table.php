<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailStokOpnamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_stok_opnames', function (Blueprint $table) {
            $table->id();
            $table->integer('stok_opname_id');
            $table->integer('barang_id');
            $table->decimal('stok_web', 10, 2);
            $table->decimal('stok_real', 10, 2);
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
        Schema::dropIfExists('detail_stok_opnames');
    }
}
