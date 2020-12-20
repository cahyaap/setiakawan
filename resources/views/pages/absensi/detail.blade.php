<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            @php
                $hari = [
                    "Sunday" => "Minggu",
                    "Monday" => "Senin",
                    "Tuesday" => "Selasa",
                    "Wednesday" => "Rabu",
                    "Thursday" => "Kamis",
                    "Friday" => "Jum'at",
                    "Saturday" => "Sabtu"
                ];
                $bulan = [
                    "January" => "Januari",
                    "February" => "Februari",
                    "March" => "Maret",
                    "April" => "April",
                    "May" => "Mei",
                    "June" => "Juni",
                    "July" => "Juli",
                    "August" => "Agustus",
                    "September" => "September",
                    "October" => "Oktober",
                    "November" => "November",
                    "December" => "Desember"
                ];
                function convertDate($date, $bulan){
                    $explode = explode(" ", $date);
                    $explode[0] = $bulan[$explode[0]];
                    return implode(" ", $explode);
                }
            @endphp
            <h3 class="box-title text-center">
                Laporan Absensi Per Karyawan
            </h3>
            {{-- <h4 class="text-center">Periode {{ convertDate($periode, $bulan) }}</h4> --}}
            <h4 class="text-center">Periode {{ date('d F Y', strtotime($lastSunday)) }} - {{ date('d F Y', strtotime($nextSaturday)) }}</h4>
            <br>
        </div>
        <div class="col-md-12">
            <div class="form-group table-responsive">
                <table class="table table-hover">
                    <tr>
                        <th width="30%">ID Karyawan</th>
                        <th>{{ $karyawan->nomor_karyawan }}</th>
                    </tr>
                    <tr>
                        <th width="30%">Nama Karyawan</th>
                        <th>{{ $karyawan->name }}</th>
                    </tr>
                </table>
                <table class="table table-hover">
                    <tr>
                        <th class="text-center" colspan="6">Aspek Penilaian</th>
                    </tr>
                    <tr>
                        <th class="text-center">Hadir</th>
                        <th class="text-center">Libur</th>
                        <th class="text-center">Izin</th>
                        <th class="text-center">Sakit</th>
                        <th class="text-center">Absen</th>
                        <th class="text-center">Cuti</th>
                    </tr>
                    <tr>
                        <th class="text-center">{{ $absensi['hadir'] }}</th>
                        <th class="text-center">{{ $absensi['libur'] }}</th>
                        <th class="text-center">{{ $absensi['izin'] }}</th>
                        <th class="text-center">{{ $absensi['sakit'] }}</th>
                        <th class="text-center">{{ $absensi['absen'] }}</th>
                        <th class="text-center">{{ $absensi['cuti'] }}</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>