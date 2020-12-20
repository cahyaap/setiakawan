<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Absensi;

class KaryawanController extends Controller
{
    private $title = "Setia Kawan | Karyawan";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karyawans = Karyawan::with(['absensi'])->get();

        $nomorKaryawan = "";
        $lastNomorKaryawan = Karyawan::select('nomor_karyawan')->orderBy('nomor_karyawan', 'desc')->limit(1)->get();
        if(count($lastNomorKaryawan) > 0){
            $nomorKaryawan = $lastNomorKaryawan[0]->nomor_karyawan + 1;
        }

        return view('pages.karyawan.index')->with([
            'title' => $this->title,
            'karyawans' => $karyawans,
            'nomorKaryawan' => $nomorKaryawan
        ]);
    }

    public function getKaryawan()
    {
        $data = [];
        $karyawans = Karyawan::with(['absensi'])->get();

        foreach($karyawans as $item){
            $isUsed = false;
            if(count($item->absensi) > 0){
                $isUsed = true;
            }
            array_push($data, [
                $item->nomor_karyawan, $item->name, $item->alamat, $item->status, $item->id, $isUsed
            ]);
        }

        return response()->json([
            'data' => $data
        ]);
    }

    public function nomorIndukExist(Request $request)
    {
        $nomor_karyawan = $request->input('nomor_karyawan');
        $karyawan = Karyawan::where('nomor_karyawan', $nomor_karyawan)->get();

        return response()->json([
            'karyawan' => count($karyawan)
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
        Karyawan::create($data);
        return redirect()->route('karyawan.index');
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
        $item = Karyawan::find($id);
        $item->nomor_karyawan = $request->input('nomor_karyawan');
        $item->name = $request->input('name');
        $item->alamat = $request->input('alamat');
        $item->status = $request->input('status');
        $item->save();
        return redirect()->route('karyawan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Karyawan::find($id);
        $item->delete();
        return redirect()->route('karyawan.index');
    }
}
