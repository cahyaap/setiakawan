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

    Route::get('/stok-barang', 'TransaksiController@stokBarang')->name('stok-barang');
    Route::get('/data-bon', 'TransaksiController@dataBon')->name('dataBon');
    Route::get('/addRowTransaksi', 'TransaksiController@addRowPembelian')->name('addRowTransaksi');
    Route::get('/daftarHarga', 'TransaksiController@daftarHarga')->name('daftarHarga');
});