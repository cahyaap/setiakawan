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
                                    <span class="nama-barang-alert" id="nama-barang-{{ $i }}-alert"></span>
                                    <datalist id="nama-barang-{{ $i }}">
                                        @foreach ($barangs as $item)
                                        <option data-id="{{ $item->id }}" value="{{ $item->name }}">
                                        @endforeach
                                    </datalist>
                                </td>
                                <td>
                                    <input type="number" min="0" name="harga[]" id="harga-{{ $i }}" value="{{ $harga }}" class="form-control text-right harga-barang">
                                    <span class="daftar-harga" id="daftar-harga-{{ $i }}" data-toggle="modal" data-target="#daftarHarga"></span>
                                </td>
                                <td><input type="number" min="0" name="kg[]" id="kg-{{ $i }}" value="{{ $berat }}" class="form-control text-right berat-barang"></td>
                                <td><input type="number" min="0" name="total[]" id="total-{{ $i }}" value="{{ $total }}" readonly class="form-control text-right total-barang"></td>
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
                                <th class="text-center"><input type="number" min="0" name="total_berat" id="total-berat" value="{{ $totalBerat }}" readonly class="form-control text-right"/></th>
                                <th class="text-center"><input type="number" min="0" name="total_transaksi" id="total-transaksi" value="{{ $totalTransaksi }}" readonly class="form-control text-right"/></th>
                            </tr>
                            <tr>
                                <th class="text-center" style="vertical-align: middle" rowspan="4" colspan="3">Pembayaran</th>
                                <td style="vertical-align: middle">Kas</td>
                                <td><input type="number" min="0" name="kas" id="kas" value="{{ $transaksi[0]->kas }}" class="form-control text-right"></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle">Transfer</td>
                                <td><input type="number" min="0" name="transfer" id="transfer" value="{{ $transaksi[0]->tf }}" class="form-control text-right"></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle">DP</td>
                                <td><input type="number" min="0" name="dp" id="dp" value="{{ $transaksi[0]->dp }}" class="form-control text-right"></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle">Hutang</td>
                                <td><input type="number" min="0" name="hutang" id="hutang" value="{{ $transaksi[0]->hutang }}" class="form-control text-right"></td>
                            </tr>
                            <tr>
                                <th class="text-center" style="vertical-align: middle" colspan="4">Sisa Pembayaran</th>
                                <td><input type="number" min="0" name="sisa" id="sisa" value="{{ $transaksi[0]->sisa }}" readonly class="form-control text-right"></td>
                            </tr>
                            <tr>
                                <th class="text-center" style="vertical-align: middle" colspan="4">Sisa Hutang</th>
                                <td>
                                    <input type="number" min="0" name="sisa_hutang" id="sisa-hutang" value="{{ $transaksi[0]->sisa_hutang }}" readonly class="form-control text-right">
                                    <input type="hidden" min="0" name="sisa_hutang_temp" id="sisa-hutang-temp">
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
                    <button class="btn btn-warning waves-effect" id="update-bon-button">Update Bon <span class="jenis-transaksi-text"></span></button>
                </div>
            </div>
        </div>
    </form>
    <hr>
</div>