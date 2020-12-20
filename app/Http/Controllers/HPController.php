<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\Hutang;

class HPController extends Controller
{
    private $title = "Setia Kawan | Hutang Piutang";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellers = Seller::orderBy('jenis', 'asc')->orderBy('name', 'asc')->get();

        return view('pages.hutang-piutang.index')->with([
            'title' => $this->title,
            'sellers' => $sellers
        ]);
    }

    public function getHutang()
    {
        $data = [];
        $hutangs = Hutang::with(['seller'])->orderBy('id', 'desc')->get();

        $i = 1;
        foreach($hutangs as $item){
            array_push($data, [
                $i++, date('Y-m-d', strtotime($item->created_at)), $item->seller->name, $item->tipe, $item->jenis, $item->jumlah, $item->ket, array($item->id, $item->seller->id, $item->transaksi_id)
            ]);
        }

        return response()->json([
            'data' => $data
        ]);
    }

    public function getHutangBySeller(Request $request)
    {
        $hutang = 0;
        $dp = 0;
        $jenis = $request->input('jenis');
        $seller = Seller::where('id', $request->input('seller_id'))->get();
        if(count($seller) > 0){
            $seller_id = $seller[0]->id;
            $tipeDp = ($jenis == 1) ? 'Piutang' : 'Hutang';

            $sisaHutang = Hutang::select('jumlah')->where('seller_id', $seller_id)->where('tipe', 'Piutang')->where('jenis', 'Hutang')->sum('jumlah');
            $bayarHutang = Hutang::select('jumlah')->where('seller_id', $seller_id)->where('tipe', 'Bayar')->where('jenis', 'Hutang')->sum('jumlah');
            $sisaDP = Hutang::select('jumlah')->where('seller_id', $seller_id)->where('tipe', $tipeDp)->where('jenis', 'DP')->sum('jumlah');
            $bayarDP = Hutang::select('jumlah')->where('seller_id', $seller_id)->where('tipe', 'Bayar')->where('jenis', 'DP')->sum('jumlah');

            $hutang = $sisaHutang - $bayarHutang;
            $dp = $sisaDP - $bayarDP;
        }

        return response()->json([
            'hutang' => (int) $hutang,
            'dp' => (int) $dp
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
        $data = [
            "seller_id" => $request->input('seller_id'),
            "tipe" => $request->input('tipe'),
            "jenis" => $request->input('jenis'),
            "jumlah" => str_replace(",", "", $request->input('jumlah')),
            "ket" => $request->input('ket')
        ];
        Hutang::create($data);
        return redirect()->route('hutang-piutang.index');
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
        $item = Hutang::find($id);
        $item->seller_id = $request->input('seller_id');
        $item->tipe = $request->input('tipe');
        $item->jenis = $request->input('jenis');
        $item->jumlah = str_replace(",", "", $request->input('jumlah'));
        $item->ket = $request->input('ket');
        $item->save();
        return redirect()->route('hutang-piutang.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Hutang::find($id);
        $item->delete();
        return redirect()->route('hutang-piutang.index');
    }
}
