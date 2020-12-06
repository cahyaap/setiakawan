<div id="daftarHarga" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addOrder" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Daftar Harga<span id="daftar-harga-nama-barang"></span></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 table-responsive" id="daftar-harga-result">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div id="detailTransaksi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addOrder" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Detail Transaksi</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center load-content"><span><i class="fa fa-spinner fa-spin"></i></span></div>
                    <div class="col-md-12" id="detail-transaksi-data"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div id="editTransaksi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addOrder" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Edit Transaksi</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center load-content"><span><i class="fa fa-spinner fa-spin"></i></span></div>
                    <div class="col-md-12" id="edit-transaksi-data"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
                <button class="btn btn-success waves-effect" id="update-bon-button">Update Bon <span class="jenis-transaksi-text"></span></button>
            </div>
        </div>
    </div>
</div>

<div id="hapusTransaksi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addOrder" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Hapus Transaksi</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <table class="table table-hover">
                        <tr>
                            <th>Seller</th>
                            <th id="seller-hapus"></th>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <th id="date-hapus"></th>
                        </tr>
                        <tr>
                            <th>Total</th>
                            <th id="total-hapus"></th>
                        </tr>
                    </table>
                </div>
                <div class="form-group">
                    <small>Semua data yang bersangkutan dengan transaksi ini akan ikut terhapus</small>
                </div>
            </div>
            <div class="modal-footer">
                <form method="POST" class="hapus-transaksi-form">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger waves-effect waves-light" href="#">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modalPengeluaran" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addOrder" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form id="bon-pengeluaran" method="POST" action="{{ route('pengeluaran.store') }}">
                @csrf
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Pengeluaran lainnya</span></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nama Pengeluaran</label>
                                <input type="text" list="list-name" name="name" id="name" class="form-control" placeholder="Masukkan nama pengeluaran disini...">
                                <datalist id="list-name">
                                    @foreach ($pengeluaranName as $item)
                                    <option value="{{ $item->name }}">
                                    @endforeach
                                </datalist>
                            </div>
                            <div class="form-group">
                                <label for="kas">Nominal</label>
                                <input type="number" name="nominal" id="nominal" class="form-control" placeholder="Masukkan jumlah pengeluaran disini..." required>
                            </div>
                            <div class="form-group">
                                <label for="ket">Keterangan</label>
                                <textarea name="ket" id="ket" rows="4" class="form-control" placeholder="Masukkan keterangan pengeluaran disini..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
                    <button class="btn btn-success waves-effect" id="pengeluaran-button">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="editPengeluaran" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addOrder" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form id="update-bon-pengeluaran" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit Pengeluaran lainnya</span></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Nama Pengeluaran</label>
                                <input type="text" list="list-name" name="name" id="edit-name" class="form-control" placeholder="Masukkan nama pengeluaran disini...">
                                <datalist id="list-name">
                                    @foreach ($pengeluaranName as $item)
                                    <option value="{{ $item->name }}">
                                    @endforeach
                                </datalist>
                            </div>
                            <div class="form-group">
                                <label for="kas">Nominal</label>
                                <input type="number" name="nominal" id="edit-nominal" class="form-control" placeholder="Masukkan jumlah pengeluaran disini..." required>
                            </div>
                            <div class="form-group">
                                <label for="ket">Keterangan</label>
                                <textarea name="ket" id="edit-ket" rows="4" class="form-control" placeholder="Masukkan keterangan pengeluaran disini..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
                    <button class="btn btn-warning waves-effect" id="update-pengeluaran-button">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="hapusPengeluaran" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addOrder" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Hapus Transaksi</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <table class="table table-hover">
                        <tr>
                            <th>Name</th>
                            <td id="delete-name-pengeluaran"></td>
                        </tr>
                        <tr>
                            <th>Nominal</th>
                            <td id="delete-nominal-pengeluaran"></td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td id="delete-ket-pengeluaran"></td>
                        </tr>
                    </table>
                </div>
                <div class="form-group">
                    Hapus data pengeluaran?
                </div>
            </div>
            <div class="modal-footer">
                <form method="POST" id="delete-bon-pengeluaran">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger waves-effect waves-light" href="#">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>