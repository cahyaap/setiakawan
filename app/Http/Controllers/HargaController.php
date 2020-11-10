<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Harga;

class HargaController extends Controller
{
    private $title = "Setia Kawan | Daftar Harga";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barangs = Barang::with(['kategori'])->orderBy('name', 'asc')->get();
        $collection = Harga::with(['barang.kategori'])->orderBy('id', 'desc')->get();
        return view('pages.harga.index')->with([
            'title' => $this->title,
            'collection' => $collection,
            'barangs' => $barangs
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
        Harga::create($data);
        return redirect()->route('harga.index');
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
        $item = Harga::find($id);
        $item->barang_id = $request->input('barang_id');
        $item->beli = $request->input('beli');
        $item->jual = $request->input('jual');
        $item->ket = $request->input('ket');
        $item->save();
        return redirect()->route('harga.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Harga::find($id);
        $item->delete();
        return redirect()->route('harga.index');
    }
}
