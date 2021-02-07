<div class="row">
    <div class="col-md-12 text-center">
        <h3 class="box-title">
            REKAP MINGGUAN<br>
            MINGGU KE-{{ $params['minggu'] }} {{ $monthArray[$params['bulan_m']] }} {{ $params['tahun_m'] }}
        </h3>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table id="tabel-rekap" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th rowspan="2" class="text-center">#</th>
                    <th rowspan="2" class="text-center">Hari</th>
                    <th rowspan="2" class="text-center">Tonase (kg)</th>
                    <th colspan="5" class="text-center">Pembayaran</th>
                </tr>
                <tr>
                    <th class="text-center">Kas</th>
                    <th class="text-center">Transfer</th>
                    <th class="text-center">DP</th>
                    <th class="text-center">Hutang</th>
                    <th class="text-center">{{ ($jenis == "2") ? "Pembelian" : "Penjualan" }}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $nomor = 1;
                    $tonase = $kas = $tf = $dp = $hutang = $transaksi = 0;
                @endphp
                @foreach ($transaksis as $item)
                @php
                    $created_at = strtotime($item->tanggal);
                    $day = $dayArray[strtolower(date('l', $created_at))];
                    $date = date('d', $created_at);
                    $month = $monthArray[strtolower(date('m', $created_at))];
                    $year = date('Y', $created_at);
                @endphp
                <tr>
                    <td class="text-center">{{ $nomor++ }}</td>
                    <td>{{ $day }}, {{ $date." ".$month." ".$year }}</td>
                    <td class="text-right">{{ number_format($item->berat, 2) }}</td>
                    <td class="text-right">{{ number_format($item->kas, 0) }}</td>
                    <td class="text-right">{{ number_format($item->tf, 0) }}</td>
                    <td class="text-right">{{ number_format($item->dp, 0) }}</td>
                    <td class="text-right">{{ number_format($item->hutang, 0) }}</td>
                    <td class="text-right">{{ number_format($item->transaksi, 0) }}</td>
                </tr>
                @php
                    $tonase += $item->berat;
                    $kas += $item->kas;
                    $tf += $item->tf;
                    $dp += $item->dp;
                    $hutang += $item->hutang;
                    $transaksi += $item->transaksi;
                @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th rowspan="2" colspan="2" class="text-center">Total</th>
                    <th rowspan="2" class="text-center">{{ number_format($tonase, 0) }}</th>
                    <th class="text-center">{{ number_format($kas, 0) }}</th>
                    <th class="text-center">{{ number_format($tf, 0) }}</th>
                    <th class="text-center">{{ number_format($dp, 0) }}</th>
                    <th class="text-center">{{ number_format($hutang, 0) }}</th>
                    <th class="text-center">{{ number_format($transaksi, 0) }}</th>
                </tr>
                <tr>
                    <th colspan="5" class="text-center">{{ number_format($kas + $tf + $dp + $hutang + $transaksi, 0) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>