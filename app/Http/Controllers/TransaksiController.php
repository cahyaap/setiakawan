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
use App\Models\Pengeluaran;
use App\Models\Profile;

use PDF;

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
        $sellers = Seller::all();
        $barangs = Barang::with(['kategori'])->orderBy('name', 'asc')->get();
        $pengeluaranName = Pengeluaran::select('name')->orderBy('name', 'asc')->groupBy('name')->get();

        return view('pages.transaksi.index')->with([
            'title' => $this->title,
            'barangs' => $barangs,
            'sellers' => $sellers,
            'pengeluaranName' => $pengeluaranName
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $barangs = Barang::with(['kategori'])->orderBy('name', 'asc')->get();

        $jenis = $request->input('jenis');

        $sellers = Seller::where('jenis', $jenis)->get();

        if($jenis == 1){ $kode = "SKPB"; }
        if($jenis == 2){ $kode = "SKPJ"; }
        $lastTransaksi = Transaksi::where('kode', 'LIKE', "%$kode%")
            ->where('created_at', 'LIKE', "%".date('Y-m-d', strtotime(now()))."%")
            ->orderBy('id', 'desc')
            ->first();
        $lastId = ($lastTransaksi) ? (int)substr($lastTransaksi->kode, -3) : 0;
        $lastId += 1;
        $lastKode = str_pad($lastId, 3, "0", STR_PAD_LEFT);
        $tahun = substr(date('Y', strtotime(now())), -2);
        $tanggal = date('md', strtotime(now()));
        $kode .= $tahun.$tanggal.$lastKode;

        return view('pages.transaksi.bon')->with([
            'barangs' => $barangs,
            'sellers' => $sellers,
            'kode' => $kode,
            'jenis' => $jenis
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
        $barangs = $request->input('barang_id');
        $hargas = $request->input('harga');
        $berats = $request->input('kg');

        if(count($barangs) > 0 && count($hargas) > 0 && count($berats) > 0){

            $jenis = $request->input('jenis');
            
            $transaksi = [
                'kode' => $request->input('kode'),
                'jenis' => $jenis,
                'kas' => (empty($request->input('kas'))) ? 0 : str_replace(",", "", $request->input('kas')),
                'tf' => (empty($request->input('transfer'))) ? 0 : str_replace(",", "", $request->input('transfer')),
                'dp' => (empty($request->input('dp'))) ? 0 : str_replace(",", "", $request->input('dp')),
                'hutang' => (empty($request->input('hutang'))) ? 0 : str_replace(",", "", $request->input('hutang')),
                'transaksi' => (empty($request->input('transaksi'))) ? 0 : str_replace(",", "", $request->input('transaksi')),
                'sisa' => (empty($request->input('sisa'))) ? 0 : $request->input('sisa'),
                'sisa_hutang' => (empty($request->input('sisa_hutang'))) ? 0 : $request->input('sisa_hutang'),
                'sisa_dp' => (empty($request->input('sisa_dp'))) ? 0 : $request->input('sisa_dp'),
                'ket' => $request->input('ket'),
                'tanggal' => date('Y-m-d', now())
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

            // update hutang jika pembayaran menggunakan hutang
            if(str_replace(",", "", $request->input('hutang')) > 0){
                $data = [
                    'seller_id' => $transaksi['seller_id'],
                    'transaksi_id' => $createdTransaksi->id,
                    'tipe' => 'Bayar',
                    'jenis' => 'Hutang',
                    'jumlah' => str_replace(",", "", $request->input('hutang')),
                    'ket' => 'Bayar pembelian dengan hutang'
                ];
                Hutang::create($data);
            }

            // update dp jika pembayaran menggunakan dp
            if(str_replace(",", "", $request->input('dp')) > 0){
                $data = [
                    'seller_id' => $transaksi['seller_id'],
                    'transaksi_id' => $createdTransaksi->id,
                    'tipe' => 'Bayar',
                    'jenis' => 'DP',
                    'jumlah' => str_replace(",", "", $request->input('dp')),
                    'ket' => 'Bayar pembelian dengan DP'
                ];
                Hutang::create($data);
            }

            // create detail transaksi
            $detailTransaksi = [];
            for($i=0;$i<count($barangs);$i++){
                if(!empty($barangs[$i]) && !empty($hargas[$i]) && !empty($berats[$i])){
                    array_push($detailTransaksi, [
                        'transaksi_id' => $createdTransaksi->id,
                        'barang_id' => $barangs[$i],
                        'harga' => str_replace(",", "", $hargas[$i]),
                        'berat' => $berats[$i],
                        'jenis' => $transaksi['jenis'],
                        'tanggal' => date('Y-m-d', now()),
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);

                    // update or create daftar harga barang
                    if($transaksi['jenis'] == 1){ // beli
                        Harga::updateOrCreate([
                            "barang_id" => $barangs[$i],
                            "beli" => str_replace(",", "", $hargas[$i]),
                            "ket" => $name
                        ],[
                            "jual" => 0
                        ]);
                    }
                    if($transaksi['jenis'] == 2){ // jual
                        Harga::updateOrCreate([
                            "barang_id" => $barangs[$i],
                            "jual" => str_replace(",", "", $hargas[$i]),
                            "ket" => $name
                        ],[
                            "beli" => 0
                        ]);
                    }

                    // update stok barang
                    $barang = Barang::find($barangs[$i]);
                    if($jenis == 1){
                        $barang->stok = $barang->stok + $berats[$i];
                    }
                    if($jenis == 2){
                        $barang->stok = $barang->stok - $berats[$i];
                    }
                    $barang->save();
                }
            }
            
            DetailTransaksi::insert($detailTransaksi);

        }

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
        $transaksi = Transaksi::with(['seller', 'detail.barang'])->where('id', $id)->get();

        return view('pages.transaksi.detail-transaksi')->with([
            'transaksi' => $transaksi
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaksi = Transaksi::with(['seller', 'detail.barang'])->where('id', $id)->get();   
        $barangs = Barang::with(['kategori'])->orderBy('name', 'asc')->get();
        
        $sellers = Seller::where('jenis', $transaksi[0]->jenis)->get();

        return view('pages.transaksi.edit-transaksi')->with([
            'transaksi' => $transaksi,
            'barangs' => $barangs,
            'sellers' => $sellers
        ]);
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
        
        $barangs = $request->input('barang_id');
        $hargas = $request->input('harga');
        $berats = $request->input('kg');
        
        if(count($barangs) > 0 && count($hargas) > 0 && count($berats) > 0){

            $jenis = $request->input('jenis');

            $transaksi = [
                'jenis' => $jenis,
                'kas' => (empty($request->input('kas'))) ? 0 : str_replace(",", "", $request->input('kas')),
                'tf' => (empty($request->input('transfer'))) ? 0 : str_replace(",", "", $request->input('transfer')),
                'dp' => (empty($request->input('dp'))) ? 0 : str_replace(",", "", $request->input('dp')),
                'hutang' => (empty($request->input('hutang'))) ? 0 : str_replace(",", "", $request->input('hutang')),
                'transaksi' => (empty($request->input('transaksi'))) ? 0 : str_replace(",", "", $request->input('transaksi')),
                'sisa' => (empty($request->input('sisa'))) ? 0 : $request->input('sisa'),
                'sisa_hutang' => (empty($request->input('sisa_hutang'))) ? 0 : $request->input('sisa_hutang'),
                'sisa_dp' => (empty($request->input('sisa_dp'))) ? 0 : $request->input('sisa_dp'),
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

            // update transaksi
            Transaksi::where('id', $id)->update($transaksi);

            // update hutang jika pembayaran menggunakan hutang
            if(str_replace(",", "", $request->input('hutang')) > 0){
                Hutang::updateOrCreate([
                    'seller_id' => $transaksi['seller_id'],
                    'transaksi_id' => $id,
                    'tipe' => 'Bayar',
                    'jenis' => 'Hutang'
                ],[
                    'jumlah' => str_replace(",", "", $request->input('hutang')),
                    'ket' => 'Bayar pembelian dengan hutang'
                ]);
            }

            // update dp jika pembayaran menggunakan dp
            if(str_replace(",", "", $request->input('dp')) > 0){
                Hutang::updateOrCreate([
                    'seller_id' => $transaksi['seller_id'],
                    'transaksi_id' => $id,
                    'tipe' => 'Bayar',
                    'jenis' => 'DP'
                ],[
                    'jumlah' => str_replace(",", "", $request->input('dp')),
                    'ket' => 'Bayar pembelian dengan DP'
                ]);
            }

            // delete old detail transaksi
            $detailTransaksiToDelete = DetailTransaksi::where('transaksi_id', $id)->get();
            foreach($detailTransaksiToDelete as $detail)
            {
                // update stok ke stok awal sebelum transaksi
                $barang = Barang::find($detail->barang_id);
                if($jenis == 1){
                    $barang->stok = $barang->stok - $detail->berat;
                }
                if($jenis == 2){
                    $barang->stok = $barang->stok + $detail->berat;
                }
                $barang->save();

                $deleteDetail = DetailTransaksi::find($detail->id);
                $deleteDetail->delete();
            }

            // recreate detail transaksi
            $detailTransaksi = [];
            for($i=0;$i<count($barangs);$i++){
                if(!empty($barangs[$i]) && !empty($hargas[$i]) && !empty($berats[$i])){
                    array_push($detailTransaksi, [
                        'transaksi_id' => $id,
                        'barang_id' => $barangs[$i],
                        'harga' => str_replace(",", "", $hargas[$i]),
                        'berat' => $berats[$i],
                        'jenis' => $transaksi['jenis'],
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);

                    // update or create daftar harga barang
                    if($transaksi['jenis'] == 1){ // beli
                        Harga::updateOrCreate([
                            "barang_id" => $barangs[$i],
                            "beli" => str_replace(",", "", $hargas[$i]),
                            "ket" => $name
                        ],[
                            "jual" => 0
                        ]);
                    }
                    if($transaksi['jenis'] == 2){ // jual
                        Harga::updateOrCreate([
                            "barang_id" => $barangs[$i],
                            "jual" => str_replace(",", "", $hargas[$i]),
                            "ket" => $name
                        ],[
                            "beli" => 0
                        ]);
                    }

                    // update stok barang
                    $barang = Barang::find($barangs[$i]);
                    if($jenis == 1){
                        $barang->stok = $barang->stok + $berats[$i];
                    }
                    if($jenis == 2){
                        $barang->stok = $barang->stok - $berats[$i];
                    }
                    $barang->save();
                }
            }
            
            DetailTransaksi::insert($detailTransaksi);

        }

        return redirect()->route('transaksi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete transaksi
        $transaksi = Transaksi::findOrFail($id);

        // delete old detail transaksi
        $detailTransaksiToDelete = DetailTransaksi::where('transaksi_id', $id)->get();
        foreach($detailTransaksiToDelete as $detail)
        {
            // update stok ke stok awal sebelum transaksi
            $barang = Barang::find($detail->barang_id);
            if($transaksi->jenis == 1){
                $barang->stok = $barang->stok - $detail->berat;
            }
            if($transaksi->jenis == 2){
                $barang->stok = $barang->stok + $detail->berat;
            }
            $barang->save();
        }

        $transaksi->delete();

        return redirect()->route('transaksi.index');
    }

    public function generateInvoice($id)
    {
        $profil = Profile::all();
        $transaksi = Transaksi::with(['seller', 'detail.barang'])->where('id', $id)->get();
        $jenis = ($transaksi[0]->jenis == 1) ? "Pembelian" : "Penjualan";
        $kode = $transaksi[0]->kode;
        $nama = $transaksi[0]->seller->name;
        $pdf = PDF::loadView('pages.transaksi.print', compact('transaksi', 'profil'))->setPaper('envelope dl', 'potrait');
        return $pdf->stream("$kode - Bon $jenis $nama.pdf");
    }

    public function dataBon(Request $request)
    {
        $data = [];
        $transaksis = Transaksi::with(['seller', 'detail' => function($query) {
            $query->select(DB::raw('SUM(harga*berat) as total'), DB::raw('SUM(berat) as berat'), 'transaksi_id')->groupBy('transaksi_id');
        }])->where('jenis', $request->input('jenis'))->orderBy('id', 'desc')->get();

        foreach($transaksis as $item){
            array_push($data, [
                $item->kode, date("m F Y", strtotime($item->created_at)), $item->seller->name, number_format($item->detail[0]->berat, 0), number_format($item->detail[0]->total, 0), $item->ket, $item->id, $item->jenis
            ]);
        }

        return response()->json([
            'data' => $data,
            'jenis' => $request->input('jenis')
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
        $jenis = trim($request->input('jenis'));
        $barang = Barang::where('name', $namaBarang)->get();
        if(count($barang) > 0){
            $barang_id = $barang[0]->id;
            $datas = Harga::with(['barang.kategori'])->where('barang_id', $barang_id);
            if($jenis == 1){
                $datas = $datas->select(DB::raw('beli as harga'), 'created_at', 'ket')->where('beli', '>', 0);
            }
            if($jenis == 2){
                $datas = $datas->select(DB::raw('jual as harga'), 'created_at', 'ket')->where('jual', '>', 0);
            }
            $datas = $datas->orderBy('id', 'desc')->limit(25)->get();
        }

        return view('pages.transaksi.daftar-harga')->with([
            'datas' => $datas,
            'namaBarang' => $namaBarang,
            'jenis' => $jenis
        ]);
    }

    public function stokBarang(Request $request)
    {
        $barang_id = $request->input('barang_id');
        $barang = Barang::find($barang_id);
        $stok = $barang->stok;

        return response()->json([
            'stok' => number_format($stok, 2)
        ]);
    }

    public function transaksiExist(Request $request)
    {
        $kode = $request->input('kode_transaksi');
        $transaksi = Transaksi::where('kode', $kode)->get();

        return response()->json([
            'transaksi' => $transaksi
        ]);
    }
}
