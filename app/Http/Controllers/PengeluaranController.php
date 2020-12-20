<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengeluaran;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $pengeluaran = Pengeluaran::all()->sortByDesc('id');

        $number = 1;
        foreach($pengeluaran as $item){
            array_push($data, [
                $number++, date("m F Y", strtotime($item->created_at)), $item->name, number_format($item->nominal, 0), $item->ket, $item->id
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
        $pengeluaran = [
            'name' => $request->input('name'),
            'nominal' => str_replace(",", "", $request->input('nominal')),
            'ket' => $request->input('ket')
        ];

        Pengeluaran::create($pengeluaran);

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
        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->name = $request->input('name');
        $pengeluaran->nominal = str_replace(",", "", $request->input('nominal'));
        $pengeluaran->ket = $request->input('ket');
        $pengeluaran->save();

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
        $pengeluaran = Pengeluaran::find($id);
        $pengeluaran->delete();

        return redirect()->route('transaksi.index');
    }
}
