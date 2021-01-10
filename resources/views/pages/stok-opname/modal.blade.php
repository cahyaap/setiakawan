<div id="detailStokOpname" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addOrder" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Detail Stok Opname</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center load-content"><span><i class="fa fa-spinner fa-spin"></i></span></div>
                    <div class="col-md-12" id="detail-stok-opname-data"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div id="hapusStokOpname" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addOrder" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Hapus Stok Opname</h4>
            </div>
            <div class="modal-body">
                <h5>Hapus stok opname <strong><span class="tanggal-stok-opname"></span></strong>?</h5>
            </div>
            <div class="modal-footer">
                <form method="POST" id="hapus-stok-opname-form">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger waves-effect waves-light" href="#">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="setStok" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addOrder" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Update Stok</h4>
            </div>
            <div class="modal-body">
                <h4>Update Stok Real menjadi Stok Database Website?</h4>
                <small>Stok di website akan berubah sesuai dengan stok real yang ada pada stok opname tanggal: <span class="tanggal-stok-opname"></span></small>
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{ route('stok-opname.set-stok') }}">
                @csrf
                    <input name="stok_opname_id" id="stok_opname_id" type="hidden"/>
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                    <button class="btn btn-warning waves-effect waves-light" href="#">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
