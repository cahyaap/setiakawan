<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <h3 class="box-title">
                Bon <span class="jenis-transaksi-text"></span> - {{ $transaksi[0]->kode }}
                <a class='btn btn-success pull-right' alt='Print' title='Print' href='{{ route('transaksi.print', $transaksi[0]->id) }}' target="_blank" data-jenis='"+row[6]+"' data-aksi='print' data-id='{{ $transaksi[0]->id }}'><span><i class='fa fa-print'></i></span> Print</a>
            </h3>
        </div>
        <div class="col-md-12">
            <div class="form-group table-responsive">
                <table class="table table-hover">
                    <tr>
                        <th>Seller</th>
                        <td>{{ $transaksi[0]->seller->name }}</td>
                    </tr>
                    <tr>
                        <th>Day</th>
                        <td>{{ date('l', strtotime($transaksi[0]->created_at)) }}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td>{{ date('d F Y', strtotime($transaksi[0]->created_at)) }}</td>
                    </tr>
                    <tr>
                        <th>Time</th>
                        <td>{{ date('h:i:s A', strtotime($transaksi[0]->created_at)) }}</td>
                    </tr>
                </table>
            </div>
            <div class="form-group table-responsive">
                <table id="tabel-barang-transaksi" class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Nama Barang</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Kg</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
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
                        <tr row-id="{{ $i }}" class="data-barang">
                            <td style="vertical-align: middle;" class="text-center">{{ $i++ }}</td>
                            <td>{{ $item->barang->name }}</td>
                            <td class="text-right">{{ number_format($harga, 0) }}</td>
                            <td class="text-right">{{ number_format($berat, 2) }}</td>
                            <td class="text-right">{{ number_format($total, 0) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="text-center"></td>
                            <th colspan="2" style="vertical-align: middle;" class="text-center">Total <span class="jenis-transaksi-text"></span></th>
                            <th class="text-right">{{ number_format($totalBerat, 2) }}</th>
                            <th class="text-right">{{ number_format($totalTransaksi, 0) }}</th>
                        </tr>
                        <tr>
                            <th class="text-center" style="vertical-align: middle" rowspan="5" colspan="3">Pembayaran</th>
                            <td style="vertical-align: middle">Kas</td>
                            <td class="text-right">{{ number_format($transaksi[0]->kas, 0) }}</td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle">Transfer</td>
                            <td class="text-right">{{ number_format($transaksi[0]->tf, 0) }}</td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle">DP</td>
                            <td class="text-right">{{ number_format($transaksi[0]->dp, 0) }}</td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle">Hutang</td>
                            <td class="text-right">{{ number_format($transaksi[0]->hutang, 0) }}</td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle">{{ ($transaksi[0]->jenis == 1) ? "Penjualan" : "Pembelian" }}</td>
                            <td class="text-right">{{ number_format($transaksi[0]->transaksi, 0) }}</td>
                        </tr>
                        <tr>
                            <th class="text-center" style="vertical-align: middle" colspan="4">Sisa Pembayaran</th>
                            <td class="text-right">{{ number_format($transaksi[0]->sisa, 0) }}</td>
                        </tr>
                        <tr @if ($transaksi[0]->jenis == 2) style="opacity: 0; position: absolute;" @endif>
                            <th class="text-center" style="vertical-align: middle" colspan="4">Sisa Hutang {{ ($transaksi[0]->jenis == 1) ? "Seller" : "Buyer" }}</th>
                            <td class="text-right">{{ number_format($transaksi[0]->sisa_hutang, 0) }}</td>
                        </tr>
                        <tr>
                            <th class="text-center" style="vertical-align: middle" colspan="4">Sisa DP {{ ($transaksi[0]->jenis == 1) ? "Seller" : "Buyer" }}</th>
                            <td class="text-right">{{ number_format($transaksi[0]->sisa_dp, 0) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="form-group">
                <label for="ket">Keterangan</label>
                <p>{{ (empty($transaksi[0]->ket)) ? "-" : $transaksi[0]->ket }}</p>
            </div>
        </div>
    </div>
</div>