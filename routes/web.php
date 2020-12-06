<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware(['auth'])->group(function () {
    
    Route::get('/', function(){ return redirect()->route('dashboard'); });
    Route::get('/add-row-transaksi', 'TransaksiController@addRowPembelian')->name('add-row-transaksi');
    Route::get('/daftar-harga', 'TransaksiController@daftarHarga')->name('daftar-harga');
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::get('/data-bon', 'TransaksiController@dataBon')->name('dataBon');
    Route::get('/seller-exist', 'SellerController@sellerExist')->name('seller-exist');
    Route::get('/stok-barang', 'TransaksiController@stokBarang')->name('stok-barang');
    Route::get('/transaksi-exist', 'TransaksiController@transaksiExist')->name('transaksi-exist');
    Route::get('/get-hutang', 'HPController@getHutang')->name('get-hutang');
    Route::get('/get-hutang-by-seller', 'HPController@getHutangBySeller')->name('get-hutang-by-seller');
    Route::get('/get-retur', 'ReturController@getRetur')->name('get-retur');
    Route::get('/get-seller', 'SellerController@getSeller')->name('get-seller');
    Route::get('/get-stok-opname', 'StokOpnameController@getStokOpname')->name('get-stok-opname');

    Route::resource('absensi', 'AbsensiController');
    Route::resource('barang', 'BarangController');
    Route::resource('harga', 'HargaController');
    Route::resource('hutang-piutang', 'HPController');
    Route::resource('kategori', 'KategoriController');
    Route::resource('pengeluaran', 'PengeluaranController');
    Route::resource('rekap', 'RekapController');
    Route::resource('retur', 'ReturController');
    Route::resource('seller', 'SellerController');
    Route::resource('stok-opname', 'StokOpnameController');
    Route::resource('transaksi', 'TransaksiController');
    
});