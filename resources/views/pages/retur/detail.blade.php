<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <h3 class="box-title">
                Retur <span class="jenis-transaksi-text"></span> - {{ $retur[0]->kode }}
            </h3>
        </div>
        <div class="col-md-12">
            <div class="form-group table-responsive">
                <table class="table table-hover">
                    <tr>
                        <th>Tanggal Retur</th>
                        <td>{{ date('d F Y, h:i:s A', strtotime($retur[0]->created_at)) }}</td>
                    </tr>
                    <tr>
                        <th>Kode <span class="jenis-transaksi-text"></span></th>
                        <td>{{ $retur[0]->transaksi->kode }}</td>
                    </tr>
                    <tr>
                        <th>Seller</th>
                        <td>{{ $retur[0]->transaksi->seller->name }}</td>
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
                        @foreach ($retur[0]->detail as $item)
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
                            <th colspan="2" style="vertical-align: middle;" class="text-center">Total Retur <span class="jenis-transaksi-text"></span></th>
                            <th class="text-right">{{ number_format($totalBerat, 2) }}</th>
                            <th class="text-right">{{ number_format($totalTransaksi, 0) }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="form-group">
                <label for="ket">Keterangan</label>
                <p>{{ (empty($retur[0]->ket)) ? "-" : $retur[0]->ket }}</p>
            </div>
        </div>
    </div>
</div>