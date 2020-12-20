<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <h3 class="box-title text-center">
                Daftar Absensi Per Karyawan
            </h3>
            <h4 class="text-center">Periode {{ $periode }}</h4><br>
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
                    <thead>
                        <tr>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Hari</th>
                            <th class="text-center">Absensi</th>
                            <th class="text-center">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
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
                                $explode[1] = $bulan[$explode[1]];
                                return implode(" ", $explode);
                            }
                        @endphp
                        
                        @foreach ($absensis as $item)
                        @php
                            $jenis = "Hadir";
                            $bg = "bg-success";
                            if($item->jenis == "i"){
                                $jenis = "Izin";
                                $bg = "bg-warning";
                            }
                            if($item->jenis == "s"){
                                $jenis = "Sakit";
                                $bg = "bg-primary";
                            }
                            if($item->jenis == "a"){
                                $jenis = "Absen";
                                $bg = "bg-danger";
                            }
                            if($item->jenis == "c"){
                                $jenis = "Cuti";
                                $bg = "bg-warning";
                            }
                            if($item->jenis == "l"){
                                $jenis = "Libur";
                                $bg = "bg-info";
                            }
                        @endphp
                        <tr>
                            <td class="text-center">{{ convertDate(date('d F Y', strtotime($item->tanggal)), $bulan) }}</td>
                            <td class="text-center">{{ $hari[date('l', strtotime($item->tanggal))] }}</td>
                            <td class="text-center"><span class="badge {{ $bg }}">{{ $jenis }}</span></td>
                            <td>{{ ($item->ket) ? $item->ket : "-" }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>