<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Harga;

class BarangController extends Controller
{
    private $title = "Setia Kawan | Daftar Barang";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Barang::with(['kategori'])->orderBy('id', 'desc')->get();
        $categories = Kategori::all();
        $barangUsed = Barang::select('id')->has('harga')->pluck('id')->toArray();
        return view('pages.barang.index')->with([
            'title' => $this->title,
            'collection' => $collection,
            'categories' => $categories,
            'barangUsed' => $barangUsed
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Barang::create($data);
        return redirect()->route('barang.index');
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
        $item = Barang::find($id);
        $item->kategori_id = $request->input('kategori_id');
        $item->name = $request->input('name');
        $item->kode = $request->input('kode');
        $item->ket = $request->input('ket');
        $item->save();
        return redirect()->route('barang.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Barang::find($id);
        $item->delete();
        return redirect()->route('barang.index');
    }
}
