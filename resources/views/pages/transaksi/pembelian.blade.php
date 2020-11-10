<div class="col-md-12">
    <h3 class="box-title">Bon Pembelian</h3>
    <hr>
    <form id="bon-pembelian" method="POST" action="{{ route('transaksi.store') }}">
        @csrf
        <input type="hidden" name="jenis" id="jenis" value="1">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="seller">Seller</label>
                    <input type="text" list="daftar-seller" name="seller" id="seller" placeholder="Tulis nama seller disini..." required class="form-control seller"/>
                    <datalist id="daftar-seller">
                        @foreach ($sellers[0] as $item)
                        <option value="{{ $item->name }}">
                        @endforeach
                    </datalist>
                </div>
                <div class="form-group table-responsive">
                    <table id="tabel-barang-pembelian" class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Nama Barang</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Kg</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody id="row-barang-pembelian">
                            @php
                                $totalData = 10
                            @endphp
                            @for ($i = 0; $i < $totalData; $i++)
                            <tr row-id="<?= $i ?>" class="data-barang">
                                <td style="vertical-align: middle;" class="text-center">{{ $i+1 }}</td>
                                <td>
                                    <input type="text" list="nama-barang-{{ $i }}" name="nama[]" id="nama-<?= $i ?>" class="form-control nama-barang">
                                    <input type="hidden" name="barang_id[]" id="barang-id-<?= $i ?>" class="form-control barang-id">
                                    <span class="nama-barang-alert" id="nama-barang-{{ $i }}-alert">Pilih nama barang dari daftar</span>
                                    <datalist id="nama-barang-<?= $i ?>">
                                        @foreach ($barangs as $item)
                                        <option data-id="{{ $item->id }}" value="{{ $item->name }}">
                                        @endforeach
                                    </datalist>
                                </td>
                                <td>
                                    <input type="number" min="0" name="harga[]" id="harga-<?= $i ?>" class="form-control text-right harga-barang">
                                    <span class="daftar-harga" id="daftar-harga-<?= $i ?>" data-toggle="modal" data-target="#daftarHarga">Lihat daftar harga</span>
                                </td>
                                <td><input type="number" min="0" name="kg[]" id="kg-<?= $i ?>" class="form-control text-right berat-barang"></td>
                                <td><input type="number" min="0" name="total[]" id="total-<?= $i ?>" readonly class="form-control text-right total-barang"></td>
                            </tr>
                            @endfor
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="text-center">
                                    <button type="button" class="btn btn-success btn-warning" last-id="{{ $totalData-1 }}" id="tambah-data-pembelian"><i class="fa fa-plus"></i></button>
                                    <span style="display: none;" class="spinner"><i class="fa fa-spinner fa-spin"></i></span>
                                </td>
                                <th colspan="2" style="vertical-align: middle;" class="text-center">Total Pembelian</th>
                                <th class="text-center"><input type="number" min="0" name="total_berat" id="total-berat" readonly class="form-control text-right"/></th>
                                <th class="text-center"><input type="number" min="0" name="total_pembelian" id="total-pembelian" readonly class="form-control text-right"/></th>
                            </tr>
                            <tr>
                                <th class="text-center" style="vertical-align: middle" rowspan="4" colspan="3">Pembayaran</th>
                                <td style="vertical-align: middle">Kas</td>
                                <td><input type="number" min="0" name="kas" id="kas" class="form-control text-right"></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle">Transfer</td>
                                <td><input type="number" min="0" name="transfer" id="transfer" class="form-control text-right"></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle">DP</td>
                                <td><input type="number" min="0" name="dp" id="dp" class="form-control text-right"></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle">Hutang</td>
                                <td><input type="number" min="0" name="hutang" id="hutang" class="form-control text-right"></td>
                            </tr>
                            <tr>
                                <th class="text-center" style="vertical-align: middle" colspan="4">Sisa Pembayaran</th>
                                <td><input type="number" min="0" name="sisa" id="sisa" readonly class="form-control text-right"></td>
                            </tr>
                            <tr>
                                <th class="text-center" style="vertical-align: middle" colspan="4">Sisa Hutang</th>
                                <td><input type="number" min="0" name="sisa_hutang" id="sisa-hutang" readonly class="form-control text-right"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="form-group">
                    <label for="ket">Keterangan</label>
                    <textarea name="ket" id="ket" rows="4" class="form-control" placeholder="Masukkan keterangan disini..."></textarea>
                </div>
                <div class="form-group text-center">
                    <button type="button" class="btn btn-default waves-effect batal-bon-button" data-transaksi="pembelian" data-dismiss="modal" id="batal-bon-pembelian">Batal</button>
                    <button class="btn btn-primary waves-effect" id="buat-bon-button">Buat Bon Pembelian</button>
                </div>
            </div>
        </div>
    </form>
    <hr>
</div>