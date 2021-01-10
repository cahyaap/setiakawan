<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;

class RekapController extends Controller
{
    private $title = "Setia Kawan | Rekap";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.rekap.index')->with([
            'title' => $this->title
        ]);
    }

    function weekOfMonth($date) {
        $firstOfMonth = strtotime(date("Y-m-01", $date));
        return intval(date("W", $date)) - intval(date("W", $firstOfMonth)) + 1;
    }

    public static function getWeeksOfMonth($currentMonth, $currentYear)
    {
        $time = strtotime("$currentYear-$currentMonth-01");  
        $firstWeek = date("W", $time);

        if ($currentMonth == 12) {
            $currentMonth = "01";
            $currentYear++;
        } else {
            $currentMonth++;
        }

        $time = strtotime("$currentYear-$currentMonth-01") - 86400;
        $lastWeek = date("W", $time);

        $weekArr = array();

        $j = 1;
        for ($i = $firstWeek; $i <= $lastWeek; $i++) {
            $weekArr[$i] = $j;
            $j++;
        }
        return $weekArr;
    }
      
    public function getRekap(Request $request)
    {
        $data = $params = [];
        $rekap = $request->input('rekap');
        $jenis = $request->input('jenis');
        if($rekap == "harian"){
            $params['tanggal'] = $request->input('tanggal');
            $transaksis = Transaksi::with(['seller', 'detail' => function($query) {
                $query->select(DB::raw('SUM(harga*berat) as total'), DB::raw('SUM(berat) as berat'), 'transaksi_id')->groupBy('transaksi_id');
            }])->where('jenis', $jenis)->where('created_at', 'like', '%'.$request->input('tanggal').'%')->orderBy('id', 'desc')->get();
        }
        if($rekap == "mingguan"){
            $params['minggu'] = $request->input('minggu');
            $params['bulan_m'] = $request->input('bulan_m');
            $params['tahun_m'] = $request->input('tahun_m');
            // rekap mingguan rabu -> selasa
            // hari ini
            $date = date('Y-m-d', strtotime(now()));
            $today = date('l', strtotime(now()));
            // last rabu = hari ini rabu ? hari ini : last rabu
            $lastRabu = ($today == "Wednesday") ? $date : date('Y-m-d', strtotime('last wednesday'));
            // next selasa = hari ini selasa ? hari ini : next selasa
            $nextSelasa = ($today == "Tuesday") ? $date : date('Y-m-d', strtotime('next tuesday'));

            $transaksis = Transaksi::with(['seller', 'detail' => function($query) {
                $query->select(DB::raw('SUM(harga*berat) as total'), DB::raw('SUM(berat) as berat'), 'transaksi_id')->groupBy('transaksi_id');
            }])->where('jenis', $jenis)->where('created_at', 'like', '%'.$request->input('tanggal').'%')->orderBy('id', 'desc')->get();
        }
        if($rekap == "bulanan"){
            $params['bulan_b'] = $request->input('bulan_b');
            $params['tahun_b'] = $request->input('tahun_b');
            $bulanan = $request->input('tahun_b')."-".$request->input('bulan_b');
            $transaksis = Transaksi::with(['seller', 'detail' => function($query) {
                $query->select(DB::raw('SUM(harga*berat) as total'), DB::raw('SUM(berat) as berat'), 'transaksi_id')->groupBy('transaksi_id');
            }])->where('jenis', $jenis)->where('created_at', 'like', '%'.$bulanan.'%')->orderBy('id', 'desc')->get();
        }

        // $nomor = 1;
        // foreach($transaksis as $item){
        //     array_push($data, [
        //         $nomor++, $item->seller->name, $item->detail[0]->berat, $item->kas, $item->tf, 0, $item->dp, $item->hutang, $item->sisa_dp, $item->sisa_hutang, $item->id
        //     ]);
        // }

        // return response()->json([
        //     'data' => $data
        // ]);

        return view("pages.rekap.$rekap")->with([
            'transaksis' => $transaksis,
            'jenis' => $jenis,
            'params' => $params
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
        //
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
