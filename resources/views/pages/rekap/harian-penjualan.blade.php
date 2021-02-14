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
<div class="row table-responsive">
    <div class="col-md-12">
        <table id="tabel-rekap" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th rowspan="2" class="text-center">#</th>
                    <th rowspan="2" class="text-center">Pembeli</th>
                    <th rowspan="2" class="text-center">Nama Barang</th>
                    <th rowspan="2" class="text-center">Tonase (kg)</th>
                    <th rowspan="2" class="text-center">Retur Penjualan (kg)</th>
                    <th rowspan="2" class="text-center">Potongan Penjualan (kg)</th>
                    <th rowspan="2" class="text-center">Harga Penjualan</th>
                    <th rowspan="2" class="text-center">Stok Barang (kg)</th>
                    <th rowspan="2" class="text-center">Pembayaran</th>
                    <th colspan="2" class="text-center">Sisa</th>
                    <th rowspan="2" class="text-center">HPP</th>
                    <th rowspan="2" class="text-center">Lebih Kurang Tonase (kg)</th>
                    <th rowspan="2" class="text-center">Laba</th>
                    <th rowspan="2" class="text-center">Keterangan</th>
                    <th rowspan="2" class="text-center">Aksi</th>
                </tr>
                <tr>
                    {{-- <th class="text-center">Kas</th>
                    <th class="text-center">Transfer</th>
                    <th class="text-center">DP</th>
                    <th class="text-center">Hutang</th>
                    <th class="text-center">{{ ($jenis == "2") ? "Pembelian" : "Penjualan" }}</th> --}}
                    <th class="text-center">Sisa DP</th>
                    <th class="text-center">Sisa Hutang</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $nomor = 1;
                    $tonase = $kas = $tf = $dp = $hutang = $transaksi = $sisa_dp = $sisa_hutang = $total = $total_laba = 0;
                @endphp
                @foreach ($transaksis as $transaksi)
                    @foreach ($transaksi->detail as $item)
                    @php
                        $btnSimpan = ($item->hpp) ? "btn-info" : "btn-warning";
                        $potongan = $item->potongan;
                        $retur = $item->retur;
                        $hpp = $item->hpp;
                        $kurleb = $item->lebih_kurang;
                        $laba = $item->laba;
                        $keterangan = $item->keterangan;
                        $tonase += $item->berat;
                        $total += $item->harga * $item->berat;
                        $total_laba += $laba;
                        $sisa_dp += $item->sisa_dp;
                        $sisa_hutang += $item->sisa_hutang;
                    @endphp
                    <tr>
                        <td class="text-center">{{ $nomor++ }}</td>
                        <td class="text-left">{{ $transaksi->seller->name }}</td>
                        <td class="text-left">{{ $item->barang->kode }}</td>
                        <td class="text-right">{{ number_format($item->berat, 2) }}</td>
                        <td class="text-center">
                            <input type="hidden" name="detail_transaksi_id[]" id="detail-transaksi-id-{{ $item->id }}" value="{{ $item->id }}">
                            <input type="number" step="0.01" name="retur[]" id="retur-{{ $item->id }}" min="0" placeholder="Jumlah retur" value="{{ $retur }}">
                            <input type="hidden" name="harga[]" id="harga-{{ $item->id }}" value="{{ $item->harga }}">
                            <input type="hidden" name="berat[]" id="berat-{{ $item->id }}" value="{{ $item->berat }}">
                            <input type="hidden" name="temp_laba[]" id="temp-laba-{{ $item->id }}" value="{{ $laba }}">
                        </td>
                        <td class="text-center">
                            <input type="number" step="0.01" name="potongan[]" id="potongan-{{ $item->id }}" min="0" value="{{ $potongan }}" placeholder="Jumlah potongan">
                        </td>
                        <td class="text-right">{{ number_format($item->harga, 0) }}</td>
                        <td class="text-right">{{ number_format($item->barang->stok, 2) }}</td>
                        <td class="text-right">{{ number_format($item->harga * $item->berat, 0) }}</td>
                        {{-- <td class="text-right">{{ number_format($transaksi->kas, 0) }}</td>
                        <td class="text-right">{{ number_format($transaksi->tf, 0) }}</td>
                        <td class="text-right">{{ number_format($transaksi->dp, 0) }}</td>
                        <td class="text-right">{{ number_format($transaksi->hutang, 0) }}</td>
                        <td class="text-right">{{ number_format($transaksi->transaksi, 0) }}</td> --}}
                        <td class="text-right">{{ number_format($transaksi->sisa_dp, 0) }}</td>
                        <td class="text-right">{{ number_format($transaksi->sisa_hutang, 0) }}</td>
                        <td class="text-center">
                            <input class="hpp" type="text" name="hpp[]" data-id="{{ $item->id }}" id="hpp-{{ $item->id }}" min="0" placeholder="Nominal HPP" value="{{ ($hpp) ? number_format($hpp, 0) : '' }}">
                        </td>
                        <td class="text-center">
                            <input class="kurleb-tonase" data-id="{{ $item->id }}" type="number" step="0.01" name="kurleb_tonase[]" id="kurleb-tonase-{{ $item->id }}" min="0" placeholder="Lebih kurang tonase" value="{{ $kurleb }}">
                        </td>
                        <td class="text-center" id="laba-{{ $item->id }}">
                            <span class='btn btn-success'>{{ number_format($laba, 0) }}</span></td>
                        <td class="text-left">
                            <textarea name="keterangan[]" id="keterangan-{{ $item->id }}" placeholder="Keterangan">{{ $keterangan }}</textarea>
                        </td>
                        <td class="text-center">
                            <span id="spin-{{ $item->id }}" style="display: none;"><i class="fa fa-spin fa-spinner"></i></span>
                            <button type="button" id="simpan-{{ $item->id }}" data-id="{{ $item->id }}" class="btn {{ $btnSimpan }} simpan">Simpan</button>
                        </td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-center">Total</th>
                    <th class="text-center">{{ number_format($tonase, 2) }}</th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                    <th class="text-center">{{ number_format($total, 0) }}</th>
                    <th class="text-center">{{ number_format($sisa_dp, 0) }}</th>
                    <th class="text-center">{{ number_format($sisa_hutang, 0) }}</th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                    <th class="text-center" id="total-laba">
                        <span class='btn btn-success'>{{ number_format($total_laba, 0) }}</span>
                    </th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>