<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan');
            $table->string('deskripsi_1')->nullable();
            $table->string('deskripsi_2')->nullable();
            $table->string('pemilik_1')->nullable();
            $table->string('pemilik_2')->nullable();
            $table->string('kontak_1')->nullable();
            $table->string('kontak_2')->nullable();
            $table->text('alamat')->nullable();
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
        Schema::dropIfExists('profiles');
    }
}
