<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;

use DateTime;

class RekapController extends Controller
{
    private $title = "Setia Kawan | Rekap";
    protected $monthArray = [
        "01" => "Januari",
        "02" => "Februari",
        "03" => "Maret",
        "04" => "April",
        "05" => "Mei",
        "06" => "Juni",
        "07" => "Juli",
        "08" => "Agustus",
        "09" => "September",
        "10" => "Oktober",
        "11" => "November",
        "12" => "Desember"
    ];
    protected $dayArray = [
        "sunday" => "Minggu",
        "monday" => "Senin",
        "tuesday" => "Selasa",
        "wednesday" => "Rabu",
        "thursday" => "Kamis",
        "friday" => "Jum'at",
        "saturday" => "Sabtu"
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.rekap.index')->with([
            'title' => $this->title,
            'years' => DB::select(DB::raw("SELECT YEAR(created_at) as year FROM transaksis GROUP BY year"))
        ]);
    }

    function weekOfMonth($date) {
        $firstOfMonth = strtotime(date("Y-m-01", $date));
        return intval(date("W", $date)) - intval(date("W", $firstOfMonth)) + 1;
    }

    public static function getWeeksOfMonth($currentMonth, $currentYear)
    {
        $time = strtotime("$currentYear-$currentMonth-01");  
        $firstWeek = (int) date("W", $time);

        if ($currentMonth == 12) {
            $currentMonth = "01";
            $currentYear++;
        } else {
            $currentMonth++;
        }

        $time = strtotime("$currentYear-$currentMonth-01") - 86400;
        $lastWeek = (int) date("W", $time);

        $weekArr = array();

        $j = 1;
        for ($i = $firstWeek; $i <= $lastWeek; $i++) {
            $weekArr[$j] = $i;
            $j++;
        }
        return $weekArr;
    }

    function getStartAndEndDate($week, $year) {
        $dto = new DateTime();
        $dto->setISODate($year, $week);
        $ret['week_start'] = $dto->format('Y-m-d')." 00:00:00";
        $dto->modify('+6 days');
        $ret['week_end'] = $dto->format('Y-m-d')." 23:59:59";
        return $ret;
    }

    public function getRekapPenjualan(Request $request)
    {
        $rekap = $request->input('rekap');
        $jenis = $request->input('jenis');

        $query = "";

        if($rekap == "harian"){
            $params['tanggal'] = $request->input('tanggal');
            $transaksis = Transaksi::with(['seller', 'detail.barang'])
                                    ->where('jenis', $jenis)
                                    ->where('created_at', 'like', '%'.$request->input('tanggal').'%')
                                    ->orderBy('id', 'desc')
                                    ->get();
        }
        if($rekap == "mingguan"){
            $params['minggu'] = $request->input('minggu');
            $params['bulan_m'] = $request->input('bulan_m');
            $params['tahun_m'] = $request->input('tahun_m');

            $weekOfMonth = $this->getWeeksOfMonth($params['bulan_m'], $params['tahun_m']);
            $dateOfWeek = $this->getStartAndEndDate($weekOfMonth[$params['minggu']], $params['tahun_m']);

            $tanggalStart = $dateOfWeek['week_start'];
            $tanggalEnd = $dateOfWeek['week_end'];

            $query = "SELECT t.tanggal, SUM(kas) as kas, SUM(tf) as tf, SUM(dp) as dp, SUM(hutang) as hutang, SUM(transaksi) as transaksi, dr.* FROM transaksis t INNER JOIN (SELECT SUM(harga*berat) as total, SUM(berat) as berat, SUM(laba) as laba, GROUP_CONCAT(keterangan separator ', ') as keterangan, d.tanggal FROM detail_transaksis d WHERE d.jenis = '$jenis' GROUP BY d.tanggal) dr ON t.tanggal = dr.tanggal WHERE t.jenis = '$jenis' AND t.tanggal BETWEEN '$tanggalStart' AND '$tanggalEnd' GROUP BY t.tanggal";

            $transaksis = DB::select(DB::raw($query));
        }
        if($rekap == "bulanan"){
            $params['bulan_b'] = $request->input('bulan_b');
            $params['tahun_b'] = $request->input('tahun_b');

            $weekOfMonth = $this->getWeeksOfMonth($params['bulan_b'], $params['tahun_b']);

            $transaksis = [];
            foreach($weekOfMonth as $key => $value){
                $dateOfWeek = $this->getStartAndEndDate($value, $params['tahun_b']);
                $tanggalStart = $dateOfWeek['week_start'];
                $tanggalEnd = $dateOfWeek['week_end'];
                $week = $this->convertWeekNumberToString($key);

                $query = "SELECT SUM(kas) as kas, SUM(tf) as tf, SUM(dp) as dp, SUM(hutang) as hutang, SUM(transaksi) as transaksi, SUM(berat) as berat, SUM(laba) as laba, GROUP_CONCAT(keterangan separator ', ') as keterangan FROM (SELECT t.jenis, SUM(kas) as kas, SUM(tf) as tf, SUM(dp) as dp, SUM(hutang) as hutang, SUM(transaksi) as transaksi, dr.* FROM transaksis t INNER JOIN (SELECT SUM(harga*berat) as total, SUM(berat) as berat, SUM(laba) as laba, GROUP_CONCAT(keterangan separator ', ') as keterangan, d.tanggal FROM detail_transaksis d WHERE d.jenis = '$jenis' GROUP BY d.tanggal) dr ON t.tanggal = dr.tanggal WHERE t.jenis = '$jenis' AND t.tanggal BETWEEN '$tanggalStart' AND '$tanggalEnd' GROUP BY t.tanggal) result GROUP BY jenis";

                $transaksis[$week] = DB::select(DB::raw($query));
            }
        }

        return view("pages.rekap.$rekap-penjualan")->with([
            'transaksis' => $transaksis,
            'jenis' => $jenis,
            'params' => $params,
            'dayArray' => $this->dayArray,
            'monthArray' => $this->monthArray
        ]);
    }
      
    public function getRekap(Request $request)
    {
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

            $weekOfMonth = $this->getWeeksOfMonth($params['bulan_m'], $params['tahun_m']);
            $dateOfWeek = $this->getStartAndEndDate($weekOfMonth[$params['minggu']], $params['tahun_m']);

            $tanggalStart = $dateOfWeek['week_start'];
            $tanggalEnd = $dateOfWeek['week_end'];

            $transaksis = DB::select(DB::raw("SELECT t.tanggal, SUM(kas) as kas, SUM(tf) as tf, SUM(dp) as dp, SUM(hutang) as hutang, SUM(transaksi) as transaksi, dr.* FROM transaksis t INNER JOIN (SELECT SUM(harga*berat) as total, SUM(berat) as berat, d.tanggal FROM detail_transaksis d WHERE d.jenis = '$jenis' GROUP BY d.tanggal) dr ON t.tanggal = dr.tanggal WHERE t.jenis = '$jenis' AND t.tanggal BETWEEN '$tanggalStart' AND '$tanggalEnd' GROUP BY t.tanggal"));
        }
        if($rekap == "bulanan"){
            $params['bulan_b'] = $request->input('bulan_b');
            $params['tahun_b'] = $request->input('tahun_b');

            $weekOfMonth = $this->getWeeksOfMonth($params['bulan_b'], $params['tahun_b']);

            $transaksis = [];
            foreach($weekOfMonth as $key => $value){
                $dateOfWeek = $this->getStartAndEndDate($value, $params['tahun_b']);
                $tanggalStart = $dateOfWeek['week_start'];
                $tanggalEnd = $dateOfWeek['week_end'];
                $week = $this->convertWeekNumberToString($key);
                $transaksis[$week] = DB::select(DB::raw("SELECT SUM(kas) as kas, SUM(tf) as tf, SUM(dp) as dp, SUM(hutang) as hutang, SUM(transaksi) as transaksi, SUM(berat) as berat FROM (SELECT t.jenis, SUM(kas) as kas, SUM(tf) as tf, SUM(dp) as dp, SUM(hutang) as hutang, SUM(transaksi) as transaksi, dr.* FROM transaksis t INNER JOIN (SELECT SUM(harga*berat) as total, SUM(berat) as berat, d.tanggal FROM detail_transaksis d WHERE d.jenis = '$jenis' GROUP BY d.tanggal) dr ON t.tanggal = dr.tanggal WHERE t.jenis = '$jenis' AND t.tanggal BETWEEN '$tanggalStart' AND '$tanggalEnd' GROUP BY t.tanggal) result GROUP BY jenis"));
            }
        }

        return view("pages.rekap.$rekap")->with([
            'transaksis' => $transaksis,
            'jenis' => $jenis,
            'params' => $params,
            'dayArray' => $this->dayArray,
            'monthArray' => $this->monthArray
        ]);
    }

    public function convertWeekNumberToString($number){
        switch($number):
            case $number == 1:
                $return = "PERTAMA";        
                break;
            case $number == 2:
                $return = "KEDUA";        
                break;
            case $number == 3:
                $return = "KETIGA";        
                break;
            case $number == 4:
                $return = "KEEMPAT";        
                break;
            case $number == 5:
                $return = "KELIMA";        
                break;
            default:
                $return = null;
                break;
        endswitch;

        return $return;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd($this->getWeeksOfMonth(2, 2021));
        // dd($this->getStartAndEndDate(5, 2021));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->id;
        $data = [
            "hpp" => trim($request->hpp),
            "lebih_kurang" => trim($request->kurleb),
            "potongan" => trim($request->potongan),
            "retur" => trim($request->retur),
            "laba" => trim($request->laba),
            "keterangan" => (trim($request->keterangan) !== "") ? trim($request->keterangan) : null
        ];

        $updateDetailTransaksi = DetailTransaksi::where('id', $id)->update($data);

        return response()->json([
            "updateDetailTransaksi" => $updateDetailTransaksi
        ]);
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
