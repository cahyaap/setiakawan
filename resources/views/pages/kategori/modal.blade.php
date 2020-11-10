<div id="tambahKategori" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Tambah Kategori</h4>
            </div>
            <form method="POST" action="{{ route('kategori.store') }}">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nama" class="control-label">Nama:</label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Masukkan nama kategori disini..." required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success waves-effect waves-light">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div id="editKategori" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Edit Kategori</h4>
            </div>
            <form method="POST" id="edit-kategori-form">
            <div class="modal-body">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nama" class="control-label">Nama:</label>
                            <input type="text" name="name" id="edit-name" class="form-control"
                                placeholder="Masukkan nama kategori disini..." required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success waves-effect waves-light">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div id="hapusKategori" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addOrder" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Hapus Kategori</h4>
            </div>
            <div class="modal-body">
                <h5>Hapus kategori <strong><span class="kategori-name"></span></strong>?</h5>
            </div>
            <div class="modal-footer">
                <form method="POST" id="hapus-kategori-form">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger waves-effect waves-light" href="#">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
