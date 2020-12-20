<div class="col-md-12 bon-transaksi">
    <h3 class="box-title">Bon <span class="jenis-transaksi-text"></span> - {{ $kode }}</h3>
    <hr>
    <form id="bon-transaksi" method="POST" action="{{ route('transaksi.store') }}">
        @csrf
        <input type="hidden" name="jenis" id="jenis">
        <input type="hidden" name="kode" id="kode" value="{{ $kode }}">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="seller">{{ ($jenis == 1) ? "Seller" : "Buyer" }}</label>
                    <input type="text" list="daftar-seller" name="seller" id="seller" onchange="sellerExist(this)" placeholder="Tulis nama seller disini..." required class="form-control seller"/>
                    <input type="hidden" name="seller_id" id="seller-id">
                    <span class="seller-alert"></span>
                    <datalist id="daftar-seller">
                        @foreach ($sellers as $item)
                        <option value="{{ $item->name }}">
                        @endforeach
                    </datalist>
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
                                $totalData = 10
                            @endphp
                            @for ($i = 0; $i < $totalData; $i++)
                            <tr row-id="{{ $i }}" class="data-barang">
                                <td style="vertical-align: middle;" class="text-center">{{ $i+1 }}</td>
                                <td>
                                    <input type="text" list="nama-barang-{{ $i }}" name="nama[]" id="nama-{{ $i }}" class="form-control nama-barang">
                                    <input type="hidden" name="barang_id[]" id="barang-id-{{ $i }}" class="form-control barang-id">
                                    <span class="nama-barang-alert" id="nama-barang-{{ $i }}-alert"></span>
                                    <datalist id="nama-barang-{{ $i }}">
                                        @foreach ($barangs as $item)
                                        <option data-id="{{ $item->id }}" value="{{ $item->name }}">
                                        @endforeach
                                    </datalist>
                                </td>
                                <td>
                                    <input type="text" name="harga[]" id="harga-{{ $i }}" class="form-control text-right harga-barang">
                                    <span class="daftar-harga" id="daftar-harga-{{ $i }}" data-toggle="modal" data-target="#daftarHarga"></span>
                                </td>
                                <td><input type="number" min="0" step="0.01" name="kg[]" id="kg-{{ $i }}" class="form-control text-right berat-barang"></td>
                                <td>
                                    <input type="text" name="view_total[]" id="view-total-{{ $i }}" readonly class="form-control text-right">
                                    <input type="hidden" name="total[]" id="total-{{ $i }}" readonly class="form-control text-right total-barang">
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="text-center">
                                    <button onclick="addNewRow(this, '#tabel-barang-transaksi .spinner', '#row-barang-transaksi')" type="button" class="btn btn-success btn-warning" last-id="{{ $totalData-1 }}" id="tambah-data-transaksi"><i class="fa fa-plus"></i></button>
                                    <span style="display: none;" class="spinner"><i class="fa fa-spinner fa-spin"></i></span>
                                </td>
                                <th colspan="2" style="vertical-align: middle;" class="text-center">Total <span class="jenis-transaksi-text"></span></th>
                                <th class="text-center">
                                    <input type="text" name="view_total_berat" id="view-total-berat" readonly class="form-control text-right"/>
                                    <input type="hidden" name="total_berat" id="total-berat" readonly class="form-control text-right"/>
                                </th>
                                <th class="text-center">
                                    <input type="text" name="view_total_transaksi" id="view-total-transaksi" readonly class="form-control text-right"/>
                                    <input type="hidden" name="total_transaksi" id="total-transaksi" readonly class="form-control text-right"/>
                                </th>
                            </tr>
                            <tr>
                                <th class="text-center" style="vertical-align: middle" rowspan="5" colspan="3">Pembayaran</th>
                                <td style="vertical-align: middle">Kas</td>
                                <td><input type="text" name="kas" id="kas" class="form-control text-right"></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle">Transfer</td>
                                <td><input type="text" name="transfer" id="transfer" class="form-control text-right"></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle">DP</td>
                                <td><input type="text" name="dp" id="dp" onkeyup="updateSisaHutangDP(this.value, '#sisa-dp-temp', '#sisa-dp', '#view-sisa-dp')" class="form-control text-right"></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle">Hutang</td>
                                <td><input type="text" name="hutang" id="hutang" onkeyup="updateSisaHutangDP(this.value, '#sisa-hutang-temp', '#sisa-hutang', '#view-sisa-hutang')" class="form-control text-right"></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle">{{ ($jenis == 1) ? "Penjualan" : "Pembelian" }}</td>
                                <td><input type="text" name="transaksi" id="transaksi" class="form-control text-right"></td>
                            </tr>
                            <tr>
                                <th class="text-center" style="vertical-align: middle" colspan="4">Sisa Pembayaran</th>
                                <td>
                                    <input type="text" name="view_sisa" id="view-sisa" readonly class="form-control text-right">
                                    <input type="hidden" name="sisa" id="sisa" readonly class="form-control text-right">
                                </td>
                            </tr>
                            <tr @if ($jenis == 2) style="opacity: 0; position: absolute;" @endif>
                                <th class="text-center" style="vertical-align: middle" colspan="4">Sisa Hutang {{ ($jenis == 1) ? "Seller" : "Buyer" }}</th>
                                <td>
                                    <input type="text" name="view_sisa_hutang" id="view-sisa-hutang" readonly class="form-control text-right">
                                    <input type="hidden" name="sisa_hutang" id="sisa-hutang" readonly class="form-control text-right">
                                    <input type="hidden" name="sisa_hutang_temp" id="sisa-hutang-temp">
                                </td>
                            </tr>
                            <tr>
                                <th class="text-center" style="vertical-align: middle" colspan="4">Sisa DP {{ ($jenis == 1) ? "Seller" : "Buyer" }}</th>
                                <td>
                                    <input type="text" name="view_sisa_dp" id="view-sisa-dp" readonly class="form-control text-right">
                                    <input type="hidden" name="sisa_dp" id="sisa-dp" readonly class="form-control text-right">
                                    <input type="hidden" name="sisa_dp_temp" id="sisa-dp-temp">
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="form-group">
                    <label for="ket">Keterangan</label>
                    <textarea name="ket" id="ket" rows="4" class="form-control" placeholder="Masukkan keterangan disini..."></textarea>
                </div>
                <div class="form-group text-center">
                    <button type="button" class="btn btn-default waves-effect batal-bon-button" data-transaksi="transaksi" id="batal-bon-transaksi">Batal</button>
                    <button class="btn btn-success waves-effect" id="buat-bon-button">Buat Bon <span class="jenis-transaksi-text"></span></button>
                </div>
            </div>
        </div>
    </form>
    <hr>
</div>