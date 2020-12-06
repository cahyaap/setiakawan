<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;

class SellerController extends Controller
{
    private $title = "Setia Kawan | Seller Buyer";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellers = Seller::with(['transaksi', 'hutang'])->get();

        return view('pages.seller.index')->with([
            'title' => $this->title,
            'sellers' => $sellers
        ]);
    }

    public function getSeller()
    {
        $data = [];
        $sellers = Seller::with(['transaksi', 'hutang'])->get();

        foreach($sellers as $item){
            $isUsed = false;
            if(count($item->transaksi) > 0 || count($item->hutang) > 0){
                $isUsed = true;
            }
            array_push($data, [
                $item->name, $item->jenis, $item->alamat, $item->id, $isUsed
            ]);
        }

        return response()->json([
            'data' => $data
        ]);
    }

    public function sellerExist(Request $request)
    {
        $name = $request->input('name');
        $seller = Seller::where('name', $name)->get();

        return response()->json([
            'seller' => count($seller)
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
        Seller::create($data);
        return redirect()->route('seller.index');
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
        $item = Seller::find($id);
        $item->name = $request->input('name');
        $item->jenis = $request->input('jenis');
        $item->alamat = $request->input('alamat');
        $item->save();
        return redirect()->route('seller.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Seller::find($id);
        $item->delete();
        return redirect()->route('seller.index');
    }
}
