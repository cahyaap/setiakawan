@php
    $tanggal = strtotime($params['tanggal']);
@endphp
<div class="row">
    <div class="col-md-12 text-center">
        <h3 class="box-title">
            REKAP HARIAN<br>
            {{ $dayArray[strtolower(date('l', $tanggal))] }}, {{ date('d', $tanggal) }} {{ $monthArray[date('m', $tanggal)] }} {{ date('Y', $tanggal) }}
        </h3>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table id="tabel-rekap" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th rowspan="2" class="text-center">#</th>
                    <th rowspan="2" class="text-center">Nama</th>
                    <th rowspan="2" class="text-center">Tonase (kg)</th>
                    <th colspan="5" class="text-center">Pembayaran</th>
                    <th colspan="2" class="text-center">Sisa</th>
                    <th rowspan="2" class="text-center">Keterangan</th>
                </tr>
                <tr>
                    <th class="text-center">Kas</th>
                    <th class="text-center">Transfer</th>
                    <th class="text-center">DP</th>
                    <th class="text-center">Hutang</th>
                    <th class="text-center">{{ ($jenis == "2") ? "Pembelian" : "Penjualan" }}</th>
                    <th class="text-center">Sisa DP</th>
                    <th class="text-center">Sisa Hutang</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $nomor = 1;
                    $tonase = $kas = $tf = $dp = $hutang = $transaksi = $sisa_dp = $sisa_hutang = 0;
                @endphp
                @foreach ($transaksis as $item)
                <tr>
                    <td class="text-center">{{ $nomor++ }}</td>
                    <td>{{ $item->seller->name }}</td>
                    <td class="text-right">{{ number_format($item->detail[0]->berat, 2) }}</td>
                    <td class="text-right">{{ number_format($item->kas, 0) }}</td>
                    <td class="text-right">{{ number_format($item->tf, 0) }}</td>
                    <td class="text-right">{{ number_format($item->dp, 0) }}</td>
                    <td class="text-right">{{ number_format($item->hutang, 0) }}</td>
                    <td class="text-right">{{ number_format($item->transaksi, 0) }}</td>
                    <td class="text-right">{{ number_format($item->sisa_dp, 0) }}</td>
                    <td class="text-right">{{ number_format($item->sisa_hutang, 0) }}</td>
                    <td>{{ $item->ket }}</td>
                </tr>
                @php
                    $tonase += $item->berat;
                    $kas += $item->kas;
                    $tf += $item->tf;
                    $dp += $item->dp;
                    $hutang += $item->hutang;
                    $transaksi += $item->transaksi;
                    $sisa_dp += $item->sisa_dp;
                    $sisa_hutang += $item->sisa_hutang;
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
                    <th class="text-center">{{ number_format($sisa_dp, 0) }}</th>
                    <th class="text-center">{{ number_format($sisa_hutang, 0) }}</th>
                    <th class="text-center">-</th>
                </tr>
                <tr>
                    <th colspan="5" class="text-center">{{ number_format($kas + $tf + $dp + $hutang + $transaksi, 0) }}</th>
                    <th class="text-center">-</th>
                    <th class="text-center">-</th>
                    <th class="text-center">-</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>