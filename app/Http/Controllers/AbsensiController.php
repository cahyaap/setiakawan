<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Karyawan;

class AbsensiController extends Controller
{
    private $title = "Setia Kawan | Absensi";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.absensi.index')->with([
            'title' => $this->title
        ]);
    }

    public function getAbsensi(Request $request)
    {
        $data = [];
        $tanggal = $request->input('tanggal');

        $now = strtotime(now());

        if(strtotime($tanggal) < $now){
            $jenis = "h";
            if(trim(date('l', strtotime($tanggal))) == "Sunday"){
                $jenis = "l";
            }
            $karyawans = Karyawan::where('status', 1)->orderBy('nomor_karyawan', 'asc')->get();
            foreach($karyawans as $k){
                $dataAbsensi = [
                    "karyawan_id" => $k->id,
                    "tanggal" => $tanggal,
                    "jenis" => $jenis
                ];

                $checkAbsensi = Absensi::where('karyawan_id', $k->id)->where('tanggal', $tanggal)->get();
                if(count($checkAbsensi) == 0){
                    Absensi::create($dataAbsensi);
                }
            }

            $absensis = Absensi::with(['karyawan' => function($query){
                $query->where('status', 1)->get();
            }])->where('tanggal', $tanggal)->get();

            foreach($absensis as $item){
                if($item->karyawan){
                    array_push($data, [
                        $item->karyawan->nomor_karyawan, $item->karyawan->name, $item->jenis, $item->ket, $item->id
                    ]);
                }
            }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dataAbsensi = Absensi::with(['karyawan'])->where('id', $id)->get();

        // data karyawan
        $karyawan_id = $dataAbsensi[0]->karyawan_id;
        $karyawan = Karyawan::find($karyawan_id);

        // data absensi per bulan
        $tanggal = $dataAbsensi[0]->tanggal;
        // $explode = explode('-', $tanggal);
        // $bulan = $explode[0]."-".$explode[1];

        $periode = date('F Y', strtotime($tanggal));
        $lastSunday = (strtolower(date('l', strtotime($tanggal))) == "sunday") ? $tanggal : date('Y-m-d', strtotime('last sunday', strtotime($tanggal)));
        $nextSaturday = date('Y-m-d', strtotime('next saturday', strtotime($tanggal)));

        $absensi['hadir'] = Absensi::select('jenis')->where('jenis', 'h')->where('karyawan_id', $karyawan_id)->whereBetween('tanggal', [$lastSunday, $nextSaturday])->count();
        $absensi['izin'] = Absensi::select('jenis')->where('jenis', 'i')->where('karyawan_id', $karyawan_id)->whereBetween('tanggal', [$lastSunday, $nextSaturday])->count();
        $absensi['sakit'] = Absensi::select('jenis')->where('jenis', 's')->where('karyawan_id', $karyawan_id)->whereBetween('tanggal', [$lastSunday, $nextSaturday])->count();
        $absensi['absen'] = Absensi::select('jenis')->where('jenis', 'a')->where('karyawan_id', $karyawan_id)->whereBetween('tanggal', [$lastSunday, $nextSaturday])->count();
        $absensi['cuti'] = Absensi::select('jenis')->where('jenis', 'c')->where('karyawan_id', $karyawan_id)->whereBetween('tanggal', [$lastSunday, $nextSaturday])->count();
        $absensi['libur'] = Absensi::select('jenis')->where('jenis', 'l')->where('karyawan_id', $karyawan_id)->whereBetween('tanggal', [$lastSunday, $nextSaturday])->count();

        return view('pages.absensi.detail')->with([
            'absensi' => $absensi,
            'karyawan' => $karyawan,
            'periode' => $periode,
            'lastSunday' => $lastSunday,
            'nextSaturday' => $nextSaturday
        ]);
    }

    public function daftarAbsensi($id)
    {
        $dataAbsensi = Absensi::with(['karyawan'])->where('id', $id)->get();

        // data karyawan
        $karyawan_id = $dataAbsensi[0]->karyawan_id;
        $karyawan = Karyawan::find($karyawan_id);

        // data absensi per bulan
        $tanggal = $dataAbsensi[0]->tanggal;
        $explode = explode('-', $tanggal);
        $bulan = $explode[0]."-".$explode[1];

        $periode = date('F Y', strtotime($tanggal));

        $absensis = Absensi::where('karyawan_id', $karyawan_id)->where('tanggal', 'LIKE', '%'.$bulan.'%')->orderBy('tanggal', 'asc')->get();

        return view('pages.absensi.daftar')->with([
            'absensis' => $absensis,
            'karyawan' => $karyawan,
            'periode' => $periode
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
        $item = Absensi::find($id);
        $item->jenis = $request->input('jenis');
        $item->ket = $request->input('ket');
        $item->save();
        return redirect()->route('absensi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
