<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use App\Models\DetailTransaksi;
use App\Models\Harga;
use App\Models\Seller;
use App\Models\Transaksi;
use App\Models\Hutang;

class TransaksiController extends Controller
{
    private $title = "Setia Kawan | Transaksi";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellers = [ Seller::where('jenis', 1)->get(), Seller::where('jenis', 2)->get() ];
        $barangs = Barang::with(['kategori'])->orderBy('name', 'asc')->get();
        $transaksis = Transaksi::with(['seller', 'detail' => function($query) {
            $query->select(DB::raw('SUM(harga*berat) as total'), 'transaksi_id')->groupBy('transaksi_id');
        }])->get();
        return view('pages.transaksi.index')->with([
            'title' => $this->title,
            'barangs' => $barangs,
            'sellers' => $sellers,
            'transaksis' => $transaksis
        ]);
    }

    public function addRowPembelian(Request $request)
    {
        $barangs = Barang::with(['kategori'])->orderBy('name', 'asc')->get();
        return view('pages.transaksi.row-pembelian')->with([
            'title' => $this->title,
            'barangs' => $barangs,
            'rowId' => $request->input('row_id')
        ]);
    }

    public function daftarHarga(Request $request)
    {
        $datas = [];
        $namaBarang = trim($request->input('nama_barang'));
        $barang = Barang::where('name', $namaBarang)->get();
        if(count($barang) > 0){
            $barang_id = $barang[0]->id;
            $datas = Harga::with(['barang.kategori'])->where('barang_id', $barang_id)->orderBy('jual', 'asc')->get();
        }
        return view('pages.transaksi.daftar-harga')->with([
            'datas' => $datas,
            'namaBarang' => $namaBarang
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.transaksi.add-transaction')->with([
            'title' => $this->title
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transaksi = [
            'jenis' => $request->input('jenis'),
            'kas' => (empty($request->input('kas'))) ? 0 : $request->input('kas'),
            'tf' => (empty($request->input('transfer'))) ? 0 : $request->input('transfer'),
            'dp' => (empty($request->input('dp'))) ? 0 : $request->input('dp'),
            'hutang' => (empty($request->input('hutang'))) ? 0 : $request->input('hutang'),
            'sisa' => (empty($request->input('sisa'))) ? 0 : $request->input('sisa'),
            'ket' => $request->input('ket')
        ];

        // check seller
        $name = ucwords(trim($request->input('seller')));
        $seller = Seller::where('name', $name)->where('jenis', $transaksi['jenis'])->get();
        if(count($seller) == 0) {
            $sellerCreated = Seller::create([
                'name' =>  $name,
                'jenis' => $transaksi['jenis']
            ]);
        }

        $transaksi['seller_id'] = (count($seller) == 0) ? $sellerCreated->id : $seller[0]->id;

        $createdTransaksi = Transaksi::create($transaksi);

        // create detail transaksi
        $detailTransaksi = [];
        $barangs = $request->input('barang_id');
        $hargas = $request->input('harga');
        $berats = $request->input('kg');
        for($i=0;$i<count($barangs);$i++){
            if(!empty($barangs[$i]) && !empty($hargas[$i]) && !empty($berats[$i])){
                array_push($detailTransaksi, [
                    'transaksi_id' => $createdTransaksi->id,
                    'barang_id' => $barangs[$i],
                    'harga' => $hargas[$i],
                    'berat' => $berats[$i]
                ]);
            }
        }
        
        DetailTransaksi::insert($detailTransaksi);

        return redirect()->route('transaksi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
