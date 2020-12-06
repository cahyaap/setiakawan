<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Pengeluaran;

class HomeController extends Controller
{
    private $title = "Setia Kawan | Dashboard";
    
    public function index()
    {
        $hariIni = date('Y-m-d', strtotime(now()));

        // jumlah barang -> total nama barang, total kg (stok)
        $barang = Barang::all()->count();
        $barangTonase = Barang::select('stok')->sum('stok');

        // total pembelian kg rp -> harian
        $pembelian['kg'] = DetailTransaksi::select('berat')->where('created_at', 'LIKE', '%'.$hariIni.'%')->where('jenis', 1)->get()->sum('berat');
        $pembelian['harga'] = DetailTransaksi::selectRaw('sum(harga*berat) as total')->where('created_at', 'LIKE', '%'.$hariIni.'%')->where('jenis', 1)->get()->sum('total');

        // total penjualan kg rp -> harian
        $penjualan['kg'] = DetailTransaksi::select('berat')->where('created_at', 'LIKE', '%'.$hariIni.'%')->where('jenis', 2)->get()->sum('berat');
        $penjualan['harga'] = DetailTransaksi::selectRaw('sum(harga*berat) as total')->where('created_at', 'LIKE', '%'.$hariIni.'%')->where('jenis', 2)->get()->sum('total');

        // total pengeluaran lainnya -> harian
        $pengeluaran = Pengeluaran::select('nominal')->where('created_at', 'LIKE', '%'.$hariIni.'%')->get()->sum('nominal');

        // menampilkan stok barang yang habis
        $stokHabis = Barang::with(['kategori'])->where('stok', 0)->orderBy('id', 'desc')->get();

        // 5 transaksi pembelian & penjualan terakhir
        $transaksis = Transaksi::with(['seller', 'detail' => function($query) {
            $query->select(DB::raw('SUM(harga*berat) as total'), 'transaksi_id')->groupBy('transaksi_id');
        }])->orderBy('id', 'desc')->limit(5)->get();

        return view('pages.dashboard')->with([
            'title' => $this->title,
            'transaksis' => $transaksis,
            'barang' => $barang,
            'barangTonase' => $barangTonase,
            'pembelian' => $pembelian,
            'penjualan' => $penjualan,
            'pengeluaran' => $pengeluaran,
            'stokHabis' => $stokHabis
        ]);
    }
}
