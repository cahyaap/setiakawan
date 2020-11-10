<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', function(){
        return redirect()->route('dashboard');
    });
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::resource('kategori', 'KategoriController');
    Route::resource('barang', 'BarangController');
    Route::resource('harga', 'HargaController');
    Route::resource('transaksi', 'TransaksiController');

    Route::get('/pembelian/addRowPembelian', 'TransaksiController@addRowPembelian')->name('addRowPembelian');
    Route::get('/pembelian/daftarHarga', 'TransaksiController@daftarHarga')->name('daftarHarga');
});