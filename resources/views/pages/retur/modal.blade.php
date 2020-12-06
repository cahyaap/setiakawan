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

<div id="detailRetur" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addOrder" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Detail Retur</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center load-content"><span><i class="fa fa-spinner fa-spin"></i></span></div>
                    <div class="col-md-12" id="detail-retur-data"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div id="hapusRetur" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addOrder" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Hapus Retur</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <table class="table table-hover">
                        <tr>
                            <th>Kode Retur</th>
                            <th id="retur-hapus"></th>
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
                    <small>Semua data yang bersangkutan dengan retur ini akan ikut terhapus</small>
                </div>
            </div>
            <div class="modal-footer">
                <form method="POST" class="hapus-retur-form">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger waves-effect waves-light" href="#">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>