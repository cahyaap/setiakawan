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
        $sellers = Seller::orderBy('name', 'asc')->get();

        return view('pages.hutang-piutang.index')->with([
            'title' => $this->title,
            'sellers' => $sellers
        ]);
    }

    public function getHutang()
    {
        $data = [];
        $hutangs = Hutang::with(['seller'])->get();

        foreach($hutangs as $item){
            array_push($data, [
                explode(' ',$item->created_at)[0], $item->seller->name, $item->tipe, $item->jumlah, $item->jenis, array($item->id, $item->seller->id)
            ]);
        }

        return response()->json([
            'data' => $data
        ]);
    }

    public function getHutangBySeller(Request $request)
    {
        $hutang = 0;
        $seller = Seller::where('name', $request->input('name'))->get();
        if(count($seller) > 0){
            $seller_id = $seller[0]->id;
            $tipe = $request->input('tipe');
            $hutangKredit = Hutang::select('jumlah')->where('seller_id', $seller_id)->where('tipe', $tipe)->where('jenis', 'Kredit')->sum('jumlah');
            $hutangDebit = Hutang::select('jumlah')->where('seller_id', $seller_id)->where('tipe', $tipe)->where('jenis', 'Debit')->sum('jumlah');
            $hutang = $hutangKredit - $hutangDebit;
        }

        return response()->json([
            'hutang' => (int)$hutang
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
        $item->jumlah = $request->input('jumlah');
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
