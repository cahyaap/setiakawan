<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Barang;

class KategoriController extends Controller
{
    private $title = "Setia Kawan | Daftar Kategori";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Kategori::all();
        $barangs = Barang::select('kategori_id')->groupBy('kategori_id')->get();
        $kategoriUsed = [];
        foreach($barangs as $barang){
            array_push($kategoriUsed, $barang->kategori_id);
        }
        return view('pages.kategori.index')->with([
            'title' => $this->title,
            'collection' => $collection,
            'kategoriUsed' => $kategoriUsed
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
        Kategori::create($data);
        return redirect()->route('kategori.index');
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
        $item = Kategori::find($id);
        $item->name = $request->input('name');
        $item->save();
        return redirect()->route('kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Kategori::find($id);
        $item->delete();
        return redirect()->route('kategori.index');
    }
}
