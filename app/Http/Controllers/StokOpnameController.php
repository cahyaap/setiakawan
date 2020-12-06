<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\StokOpname;
use App\Models\DetailStokOpname;

class StokOpnameController extends Controller
{
    private $title = "Setia Kawan | Stok Opname";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.stok-opname.index')->with([
            'title' => $this->title
        ]);
    }

    public function getStokOpname()
    {
        $data = [];
        $stokOpnames = StokOpname::with(['detail'])->orderBy('id', 'desc')->get();

        foreach($stokOpnames as $item){
            $stokWeb = $item->detail()->sum('stok_web');
            $stokReal = $item->detail()->sum('stok_real');
            $selisih = $stokReal - $stokWeb;
            array_push($data, [
                date('Y-m-d h:i:s', strtotime($item->created_at)), number_format($stokWeb, 2), number_format($stokReal, 2), number_format($selisih, 2), ($item->ket) ? $item->ket : "-", $item->id
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
    public function create()
    {
        $barangs = Barang::with(['kategori'])->orderBy('id', 'desc')->get();
        return view('pages.stok-opname.create')->with([
            'title' => $this->title,
            'barangs' => $barangs
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
        // create stok opname
        $stokOpname = StokOpname::create([
            'ket' => $request->input('ket'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        // create detail stok opname
        $detailStokOpname = [];
        $barangs = $request->input('barang_id');
        $stokReals = $request->input('stok_real');
        $stokWebs = $request->input('stok_web');
        for($i=0;$i<count($barangs);$i++){
            if(!empty($barangs[$i]) && !empty($stokReals[$i]) && !empty($stokWebs[$i])){
                array_push($detailStokOpname, [
                    'stok_opname_id' => $stokOpname->id,
                    'barang_id' => $barangs[$i],
                    'stok_web' => $stokWebs[$i],
                    'stok_real' => $stokReals[$i],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
        
        DetailStokOpname::insert($detailStokOpname);

        return redirect()->route('stok-opname.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stokOpname = StokOpname::findOrFail($id);
        $barangs = Barang::with(['kategori', 'stokOpname' => function($query) use($id) {
            $query->where('stok_opname_id', $id);
        }])->orderBy('id', 'desc')->get();

        return view('pages.stok-opname.detail')->with([
            'stokOpname' => $stokOpname,
            'barangs' => $barangs,
            'title' => $this->title,
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
        $stokOpname = StokOpname::findOrFail($id);
        $barangs = Barang::with(['kategori', 'stokOpname' => function($query) use($id) {
            $query->where('stok_opname_id', $id);
        }])->orderBy('id', 'desc')->get();
        return view('pages.stok-opname.edit')->with([
            'title' => $this->title,
            'barangs' => $barangs,
            'id' => $id,
            'stokOpname' => $stokOpname
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
        // update stok opname
        $stokOpname = StokOpname::findOrFail($id);
        $stokOpname->ket = $request->input('ket');
        $stokOpname->save();

        // delete previous stok opname
        DetailStokOpname::where('stok_opname_id', $id)->delete();

        // recreate detail stok opname
        $detailStokOpname = [];
        $barangs = $request->input('barang_id');
        $stokReals = $request->input('stok_real');
        $stokWebs = $request->input('stok_web');
        for($i=0;$i<count($barangs);$i++){
            if(!empty($barangs[$i]) && !empty($stokReals[$i]) && !empty($stokWebs[$i])){
                array_push($detailStokOpname, [
                    'stok_opname_id' => $id,
                    'barang_id' => $barangs[$i],
                    'stok_web' => $stokWebs[$i],
                    'stok_real' => $stokReals[$i],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
        
        DetailStokOpname::insert($detailStokOpname);

        return redirect()->route('stok-opname.index');
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
        $stokOpname = StokOpname::findOrFail($id);
        $stokOpname->delete();

        return redirect()->route('stok-opname.index');
    }
}
