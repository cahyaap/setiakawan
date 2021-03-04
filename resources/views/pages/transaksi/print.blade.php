<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    @php
        $jenis = ($transaksi[0]->jenis == 1) ? "Pembelian" : "Penjualan";
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
    <head>
        <title>Bon {{ $jenis }} - {{ $transaksi[0]->kode }}</title>
        <style>
            @page { 
                size: 75mm 150mm;
                margin: 30px; 
                font-size: 10px;
            }
            * {
                font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            }
            table {
                width: 100%;
            }
            .print-header-logo {
                width: 25%;
                display: inline-block;
                vertical-align: middle;
                position: relative;
                padding-top: 10px;
                transform: scaleY(1.25);
            }
            .print-header-text {
                width: 73%;
                display: inline-block;
                vertical-align: top;
            }
            .print-header-logo img {
                width: 100%;
            }
            /* .detail th, .detail td {
                font-family: 'Times New Roman', Times, serif;
            } */
        </style>
    </head>
    <body>
        <div>
            <div>
                <div class="print-header">
                    <div class="print-header-logo">
                        <img src="{{ public_path('logo-sk.png') }}">
                    </div>
                    <div class="print-header-text">
                        <table>
                            <tr>
                                <td align="center" style="font-size: 15px;">{{ $profil[0]->nama_perusahaan }}</td>
                            </tr>
                            <tr>
                                <td align="center" style="font-size: 10px;">{{ $profil[0]->deskripsi_1 }}<br>{{ $profil[0]->deskripsi_2 }}</td>
                            </tr>
                            <tr>
                                <td align="center" style="font-size: 7px;">{{ $profil[0]->alamat }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <hr>
                <div>
                    <div>
                        <table>
                            <tr>
                                <td width="67.5%">
                                    <span style="text-decoration: underline;">{{ $profil[0]->pemilik_1 }}</span><br>
                                    {{ $profil[0]->kontak_1 }}
                                </td>
                                <td width="32.5%">
                                    <span style="text-decoration: underline;">{{ $profil[0]->pemilik_2 }}</span><br>
                                    {{ $profil[0]->kontak_2 }}
                                </td>
                            </tr>
                        </table>
                        <hr>
                        <table class="bon-header">
                            <tr>
                                <td>Kode</td>
                                <td>{{ $transaksi[0]->kode }}</td>
                            </tr>
                            <tr>
                                <td>{{ ($transaksi[0]->jenis == 1) ? "Seller" : "Buyer" }}</td>
                                <td>{{ $transaksi[0]->seller->name }}</td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td>{{ convertDate(date('d F Y', strtotime($transaksi[0]->created_at)), $bulan) }}</td>
                            </tr>
                            <tr>
                                <td>Day</td>
                                <td>{{ $hari[date('l', strtotime($transaksi[0]->created_at))] }}</td>
                            </tr>
                            <tr>
                                <td>Time</td>
                                <td>{{ date('h:i:s A', strtotime($transaksi[0]->created_at)) }}</td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <br>
                        <table class="detail">
                            <thead>
                                <tr>
                                    <th align="center">Nama</th>
                                    <th align="center">Harga</th>
                                    <th align="center">(Kg)</th>
                                    <th align="center">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalBerat = 0;
                                    $totalTransaksi = 0;
                                @endphp
                                @foreach ($transaksi[0]->detail as $item)
                                    @php
                                        $harga = $item->harga;
                                        $berat = $item->berat;
                                        $total = $harga * $berat;
                                        $totalBerat += $berat;
                                        $totalTransaksi += $total;
                                    @endphp
                                <tr>
                                    <td>{{ $item->barang->kode }}</td>
                                    <td align="right">{{ number_format($harga, 0) }}</td>
                                    <td align="right">{{ number_format($berat, 2) }}</td>
                                    <td align="right">{{ number_format($total, 0) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2" style="vertical-align: middle;">Total</th>
                                    <th align="right">{{ number_format($totalBerat, 2) }}</th>
                                    <th align="right">{{ number_format($totalTransaksi, 0) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>