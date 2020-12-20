<div class="col-md-12 bon-transaksi">
    <h3 class="box-title">Retur <span class="jenis-transaksi-text"></span> - {{ $retur[0]->kode }}</h3>
    <hr>
    <form id="bon-transaksi" method="POST" action="{{ route('retur.update', $retur[0]->id) }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="kode" id="kode" value="{{ $retur[0]->kode }}">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="kode-transaksi">Kode Transaksi</label>
                    <input type="text" list="daftar-transaksi" name="kode_transaksi" id="kode-transaksi" onchange="transaksiExist(this)" placeholder="Tulis kode transaksi disini..." required class="form-control transaksi" value="{{ $retur[0]->transaksi->kode }}"/>
                    <input type="hidden" name="transaksi_id" id="transaksi-id" value="{{ $retur[0]->transaksi->id }}">
                    <span class="transaksi-alert"><a class='aksi-btn detail-btn' alt='Detail' title='Detail' href='#detailTransaksi' data-aksi='detail-transaksi' data-transaksi-id='{{ $retur[0]->transaksi->id }}' data-jenis='{{ $retur[0]->transaksi->jenis }}' data-toggle='modal' data-target='#detailTransaksi'>Detail Transaksi</a></span>
                    <datalist id="daftar-transaksi">
                        @foreach ($transaksis as $item)
                        <option value="{{ $item->kode }}">
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
                                $i = 0;
                                $totalData = count($retur[0]->detail);
                                $totalBerat = 0;
                                $totalTransaksi = 0;
                            @endphp
                            @foreach ($retur[0]->detail as $detail)
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
                                    <span class="nama-barang-alert" id="nama-barang-{{ $i }}-alert"></span>
                                    <datalist id="nama-barang-{{ $i }}">
                                        @foreach ($barangs as $item)
                                        <option data-id="{{ $item->id }}" value="{{ $item->name }}">
                                        @endforeach
                                    </datalist>
                                </td>
                                <td>
                                    <input type="text" name="harga[]" id="harga-{{ $i }}" value="{{ number_format($harga, 0) }}" class="form-control text-right harga-barang">
                                    <span class="daftar-harga" id="daftar-harga-{{ $i }}" data-toggle="modal" data-target="#daftarHarga"></span>
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
                        </tfoot>
                    </table>
                </div>
                <div class="form-group">
                    <label for="ket">Keterangan</label>
                    <textarea name="ket" id="ket" rows="4" class="form-control" placeholder="Masukkan keterangan disini...">{{ $retur[0]->ket }}</textarea>
                </div>
                <div class="form-group text-center">
                    <button type="button" class="btn btn-default waves-effect batal-bon-button" data-transaksi="transaksi" id="batal-bon-transaksi">Batal</button>
                    <button class="btn btn-success waves-effect submit-retur-btn" id="update-bon-button">Update Retur <span class="jenis-transaksi-text"></span></button>
                </div>
            </div>
        </div>
    </form>
    <hr>
</div>