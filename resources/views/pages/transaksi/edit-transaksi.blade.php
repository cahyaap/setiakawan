<div class="col-md-12 bon-transaksi">
    <h3 class="box-title">Update Bon <span class="jenis-transaksi-text"></span> - {{ $transaksi[0]->kode }}</h3>
    <hr>
    <form id="update-bon-transaksi" method="POST" action="">
        @csrf
        @method('PUT')
        <input type="hidden" name="transaksi_id" id="transaksi_id" value="{{ $transaksi[0]->id }}">
        <input type="hidden" name="jenis" id="jenis">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group table-responsive">
                    <div class="form-group">
                        <label for="seller">Seller</label>
                        <input type="text" list="daftar-seller" name="seller" id="seller" onchange="sellerExist(this)" placeholder="Tulis nama seller disini..." required class="form-control seller" value="{{ $transaksi[0]->seller->name }}"/>
                        <input type="hidden" name="seller_id" id="seller-id" value="{{ $transaksi[0]->seller->id }}">
                        <datalist id="daftar-seller">
                            @foreach ($sellers as $item)
                            <option value="{{ $item->name }}">
                            @endforeach
                        </datalist>
                    </div>
                </div>
                <div class="form-group table-responsive">
                    <table class="table table-hover">
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
                        <tbody id="row-barang-transaksi">
                            @php
                                $i = 0;
                                $totalData = count($transaksi[0]->detail);
                                $totalBerat = 0;
                                $totalTransaksi = 0;
                            @endphp
                            @foreach ($transaksi[0]->detail as $detail)
                                @php
                                    $harga = $detail->harga;
                                    $berat = $detail->berat;
                                    $total = $harga * $berat;
                                    $totalBerat += $berat;
                                    $totalTransaksi += $total;
                                @endphp
                            <tr row-id="{{ $i }}" class="data-barang">
                                <td style="vertical-align: middle;" class="text-center">{{ $i+1 }}</td>
                                <td>
                                    <input type="text" list="nama-barang-{{ $i }}" name="nama[]" id="nama-{{ $i }}" value="{{ $detail->barang->name }}" class="form-control nama-barang">
                                    <input type="hidden" name="barang_id[]" id="barang-id-{{ $i }}" value="{{ $detail->barang->id }}" class="form-control barang-id">
                                    <span class="nama-barang-alert" id="nama-barang-{{ $i }}-alert">Stok saat ini: <strong>{{ $detail->barang->stok }} kg</strong></span>
                                    <datalist id="nama-barang-{{ $i }}">
                                        @foreach ($barangs as $item)
                                        <option data-id="{{ $item->id }}" value="{{ $item->kode }}">
                                        @endforeach
                                    </datalist>
                                </td>
                                <td>
                                    <input type="text" name="harga[]" id="harga-{{ $i }}" value="{{ number_format($harga, 0) }}" class="form-control text-right harga-barang">
                                    <span class="daftar-harga" id="daftar-harga-{{ $i }}" nama-barang="{{ $detail->barang->name }}" data-toggle="modal" data-target="#daftarHarga">Lihat daftar harga</span>
                                </td>
                                <td><input type="number" min="0" step="0.01" name="kg[]" id="kg-{{ $i }}" value="{{ $berat }}" class="form-control text-right berat-barang"></td>
                                <td>
                                    <input type="text" name="view_total[]" id="view-total-{{ $i }}" value="{{ number_format($total, 0) }}" readonly class="form-control text-right">
                                    <input type="hidden" name="total[]" id="total-{{ $i }}" value="{{ $total }}" readonly class="form-control text-right total-barang">
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="text-center">
                                    <button type="button" class="btn btn-success btn-warning" onclick="addNewRow(this, '#tabel-barang-transaksi .spinner', '#row-barang-transaksi')" last-id="{{ $totalData-1 }}" id="tambah-data-transaksi"><i class="fa fa-plus"></i></button>
                                    <span style="display: none;" class="spinner"><i class="fa fa-spinner fa-spin"></i></span>
                                </td>
                                <th colspan="2" style="vertical-align: middle;" class="text-center">Total <span class="jenis-transaksi-text"></span></th>
                                <th class="text-center">
                                    <input type="text" name="view_total_berat" id="view-total-berat" value="{{ number_format($totalBerat, 0) }}" readonly class="form-control text-right"/>
                                    <input type="hidden" name="total_berat" id="total-berat" value="{{ $totalBerat }}" readonly class="form-control text-right"/>
                                </th>
                                <th class="text-center">
                                    <input type="text" name="view_total_transaksi" id="view-total-transaksi" value="{{ number_format($totalTransaksi, 0) }}" readonly class="form-control text-right"/>
                                    <input type="hidden" name="total_transaksi" id="total-transaksi" value="{{ $totalTransaksi }}" readonly class="form-control text-right"/>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center" style="vertical-align: middle" rowspan="5" colspan="3">Pembayaran</th>
                                <td style="vertical-align: middle">Kas</td>
                                <td><input type="text" name="kas" id="kas" value="{{ number_format($transaksi[0]->kas, 0) }}" class="form-control text-right"></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle">Transfer</td>
                                <td><input type="text" name="transfer" id="transfer" value="{{ number_format($transaksi[0]->tf, 0) }}" class="form-control text-right"></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle">DP</td>
                                <td><input type="text" name="dp" id="dp" onkeyup="updateSisaHutangDP(this.value, '#sisa-dp-temp', '#sisa-dp', '#view-sisa-dp')" value="{{ number_format($transaksi[0]->dp, 0) }}" class="form-control text-right"></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle">Hutang</td>
                                <td><input type="text" name="hutang" id="hutang" onkeyup="updateSisaHutangDP(this.value, '#sisa-hutang-temp', '#sisa-hutang', '#view-sisa-hutang')" value="{{ number_format($transaksi[0]->hutang, 0) }}" class="form-control text-right"></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle">{{ ($transaksi[0]->jenis == 1) ? "Penjualan" : "Pembelian" }}</td>
                                <td><input type="text" name="transaksi" id="transaksi" value="{{ number_format($transaksi[0]->transaksi, 0) }}" class="form-control text-right"></td>
                            </tr>
                            <tr>
                                <th class="text-center" style="vertical-align: middle" colspan="4">Sisa Pembayaran</th>
                                <td>
                                    <input type="text" name="view_sisa" id="view-sisa" value="{{ number_format($transaksi[0]->sisa, 0) }}" readonly class="form-control text-right">
                                    <input type="hidden" name="sisa" id="sisa" value="{{ $transaksi[0]->sisa }}" readonly class="form-control text-right">
                                </td>
                            </tr>
                            <tr @if ($transaksi[0]->jenis == 2) style="opacity: 0; position: absolute;" @endif>
                                <th class="text-center" style="vertical-align: middle" colspan="4">Sisa Hutang {{ ($transaksi[0]->jenis == 1) ? "Seller" : "Buyer" }}</th>
                                <td>
                                    <input type="text" name="view_sisa_hutang" id="view-sisa-hutang" value="{{ number_format($transaksi[0]->sisa_hutang, 0) }}" readonly class="form-control text-right">
                                    <input type="hidden" name="sisa_hutang" id="sisa-hutang" value="{{ $transaksi[0]->sisa_hutang }}" readonly class="form-control text-right">
                                    <input type="hidden" name="sisa_hutang_temp" id="sisa-hutang-temp">
                                </td>
                            </tr>
                            <tr>
                                <th class="text-center" style="vertical-align: middle" colspan="4">Sisa DP {{ ($transaksi[0]->jenis == 1) ? "Seller" : "Buyer" }}</th>
                                <td>
                                    <input type="text" name="view_sisa_dp" id="view-sisa-dp" value="{{ number_format($transaksi[0]->sisa_dp, 0) }}" readonly class="form-control text-right">
                                    <input type="hidden" name="sisa_dp" id="sisa-dp" value="{{ $transaksi[0]->sisa_dp }}" readonly class="form-control text-right">
                                    <input type="hidden" name="sisa_dp_temp" id="sisa-dp-temp">
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="form-group">
                    <label for="ket">Keterangan</label>
                    <textarea name="ket" id="ket" rows="4" class="form-control" placeholder="Masukkan keterangan disini...">{{ $transaksi[0]->ket }}</textarea>
                </div>
                <div class="form-group text-center">
                    <button type="button" class="btn btn-default waves-effect batal-bon-button" data-transaksi="transaksi" id="batal-bon-transaksi">Batal</button>
                    <button class="btn btn-warning waves-effect" id="buat-bon-button">Update Bon <span class="jenis-transaksi-text"></span></button>
                </div>
            </div>
        </div>
    </form>
    <hr>
</div>