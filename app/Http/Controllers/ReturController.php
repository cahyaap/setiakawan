<?php

namespace App\Http\Controllers;

use App\Models\Retur;
use App\Models\DetailRetur;
use App\Models\Transaksi;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturController extends Controller
{
    private $title = "Setia Kawan | Retur";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.retur.index')->with([
            'title' => $this->title
        ]);
    }

    public function getRetur()
    {
        $data = [];
        $returs = Retur::with(['transaksi.seller','detail' => function($query) {
            $query->select(DB::raw('SUM(harga*berat) as total'), 'retur_id')->groupBy('retur_id');
        }])->orderBy('id', 'desc')->get();

        foreach($returs as $item){
            array_push($data, [
                date("m F Y", strtotime($item->created_at)), $item->kode, $item->transaksi->kode, $item->transaksi->seller->name, number_format($item->detail[0]->total, 0), $item->ket, [$item->id, $item->transaksi->id, $item->transaksi->jenis]
            ]);
        }

        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $jenis = $request->input('jenis');

        $transaksis = Transaksi::doesntHave('retur')->where('jenis', $jenis)->get();
        $barangs = Barang::with(['kategori'])->orderBy('name', 'asc')->get();

        if($jenis == 1){ $kode = "SKRB"; }
        if($jenis == 2){ $kode = "SKRJ"; }
        $lastRetur = Retur::where('kode', 'LIKE', "%$kode%")
            ->where('created_at', 'LIKE', "%".date('Y-m-d', strtotime(now()))."%")
            ->orderBy('id', 'desc')
            ->first();
        $lastId = ($lastRetur) ? (int)substr($lastRetur->kode, -3) : 0;
        $lastId += 1;
        $lastKode = str_pad($lastId, 3, "0", STR_PAD_LEFT);
        $tahun = substr(date('Y', strtotime(now())), -2);
        $tanggal = date('md', strtotime(now()));
        $kode .= $tahun.$tanggal.$lastKode;

        return view('pages.retur.tambah')->with([
            'barangs' => $barangs,
            'transaksis' => $transaksis,
            'kode' => $kode
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
        $retur = [
            'transaksi_id' => $request->input('transaksi_id'),
            'kode' => $request->input('kode'),
            'ket' => $request->input('ket')
        ];

        $createdRetur = Retur::create($retur);

        $transaksi = Transaksi::findOrFail($request->input('transaksi_id'));

        // create detail retur
        $detailRetur = [];
        $barangs = $request->input('barang_id');
        $hargas = $request->input('harga');
        $berats = $request->input('kg');
        for($i=0;$i<count($barangs);$i++){
            if(!empty($barangs[$i]) && !empty($hargas[$i]) && !empty($berats[$i])){
                array_push($detailRetur, [
                    'retur_id' => $createdRetur->id,
                    'barang_id' => $barangs[$i],
                    'harga' => $hargas[$i],
                    'berat' => $berats[$i],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                // update stok barang
                $barang = Barang::find($barangs[$i]);
                if($transaksi->jenis == 1){
                    $barang->stok = $barang->stok - $berats[$i];
                }
                if($transaksi->jenis == 2){
                    $barang->stok = $barang->stok + $berats[$i];
                }
                $barang->save();
            }
        }
        
        DetailRetur::insert($detailRetur);

        return redirect()->route('retur.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $retur = Retur::with(['transaksi.seller', 'detail.barang'])->where('id', $id)->get();

        return view('pages.retur.detail')->with([
            'retur' => $retur
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $jenis = $request->input('jenis');

        $retur = Retur::with(['transaksi', 'detail.barang'])->where('id', $id)->get();
        $transaksis = Transaksi::where('jenis', $jenis)->get();
        $barangs = Barang::with(['kategori'])->orderBy('name', 'asc')->get();

        return view('pages.retur.edit')->with([
            'transaksis' => $transaksis,
            'barangs' => $barangs,
            'retur' => $retur
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
        $retur = [
            'transaksi_id' => $request->input('transaksi_id'),
            'ket' => $request->input('ket')
        ];

        // update retur data
        Retur::where('id', $id)->update($retur);

        $transaksi = Transaksi::findOrFail($request->input('transaksi_id'));

        $detailReturOld = DetailRetur::where('retur_id', $id)->get();
        foreach($detailReturOld as $detail){
            // update stok ke stok awal sebelum transaksi
            $barang = Barang::find($detail->barang_id);
            if($transaksi->jenis == 1){
                $barang->stok = $barang->stok + $detail->berat;
            }
            if($transaksi->jenis == 2){
                $barang->stok = $barang->stok - $detail->berat;
            }
            $barang->save();

            $deleteDetail = DetailRetur::find($detail->id);
            $deleteDetail->delete();
        }

        // recreate detail retur
        $detailRetur = [];
        $barangs = $request->input('barang_id');
        $hargas = $request->input('harga');
        $berats = $request->input('kg');
        for($i=0;$i<count($barangs);$i++){
            if(!empty($barangs[$i]) && !empty($hargas[$i]) && !empty($berats[$i])){
                array_push($detailRetur, [
                    'retur_id' => $id,
                    'barang_id' => $barangs[$i],
                    'harga' => $hargas[$i],
                    'berat' => $berats[$i],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                // update stok barang
                $barang = Barang::find($barangs[$i]);
                if($transaksi->jenis == 1){
                    $barang->stok = $barang->stok - $berats[$i];
                }
                if($transaksi->jenis == 2){
                    $barang->stok = $barang->stok + $berats[$i];
                }
                $barang->save();
            }
        }
        
        DetailRetur::insert($detailRetur);

        return redirect()->route('retur.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete retur
        $retur = Retur::findOrFail($id);

        $transaksi = Transaksi::findOrFail($retur->transaksi_id);

        // delete old detail transaksi
        $detailReturToDelete = DetailRetur::where('retur_id', $id)->get();
        foreach($detailReturToDelete as $detail)
        {
            // update stok ke stok awal sebelum transaksi
            $barang = Barang::find($detail->barang_id);
            if($transaksi->jenis == 1){
                $barang->stok = $barang->stok + $detail->berat;
            }
            if($transaksi->jenis == 2){
                $barang->stok = $barang->stok - $detail->berat;
            }
            $barang->save();
        }

        $retur->delete();

        return redirect()->route('retur.index');
    }
}
