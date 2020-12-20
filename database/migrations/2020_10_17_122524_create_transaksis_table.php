<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->integer('seller_id');
            $table->integer('jenis');
            $table->bigInteger('kas')->default(0);
            $table->bigInteger('tf')->default(0);
            $table->bigInteger('dp')->default(0);
            $table->bigInteger('hutang')->default(0);
            $table->bigInteger('transaksi')->default(0);
            $table->bigInteger('sisa')->default(0);
            $table->bigInteger('sisa_hutang')->default(0);
            $table->bigInteger('sisa_dp')->default(0);
            $table->text('ket')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('transaksis');
    }
}
