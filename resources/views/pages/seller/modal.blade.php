<div id="tambahSeller" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Tambah Seller</h4>
            </div>
            <form method="POST" action="{{ route('seller.store') }}">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nama" class="control-label">Nama:</label>
                            <input type="text" list="daftar-seller" name="name" id="name" class="form-control" placeholder="Masukkan nama seller disini..." required>
                            <datalist id="daftar-seller">
                                @foreach ($sellers as $item)
                                <option value="{{ $item->name }}">
                                @endforeach
                            </datalist>
                        </div>
                        <div class="form-group">
                            <label for="jenis" class="control-label">Jenis:</label>
                            <select name="jenis" id="jenis" class="form-control" required>
                                <option value="">-- Pilih jenis pelanggan --</option>
                                <option value="1">Buyer</option>
                                <option value="2">Seller</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="control-label">Alamat:</label>
                            <textarea name="alamat" id="alamat" rows="4" class="form-control" placeholder="Masukkan alamat seller disini..."></textarea>
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

<div id="editSeller" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Edit Seller</h4>
            </div>
            <form method="POST" id="edit-seller-form">
            <div class="modal-body">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="edit-nama" class="control-label">Nama:</label>
                            <input type="text" list="daftar-seller-edit" name="name" id="edit-name" class="form-control" placeholder="Masukkan nama seller disini..." required>
                        </div>
                        <datalist id="daftar-seller-edit">
                            @foreach ($sellers as $item)
                            <option value="{{ $item->name }}">
                            @endforeach
                        </datalist>
                        <div class="form-group">
                            <label for="edit-jenis" class="control-label">Jenis:</label>
                            <select name="jenis" id="edit-jenis" class="form-control" required>
                                <option value="">-- Pilih jenis pelanggan --</option>
                                <option value="1">Buyer</option>
                                <option value="2">Seller</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-alamat" class="control-label">Alamat:</label>
                            <textarea name="alamat" id="edit-alamat" rows="4" class="form-control" placeholder="Masukkan alamat seller disini..."></textarea>
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

<div id="hapusSeller" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addOrder" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Hapus Seller</h4>
            </div>
            <div class="modal-body">
                <h5>Hapus seller <strong><span class="seller-name"></span></strong>?</h5>
            </div>
            <div class="modal-footer">
                <form method="POST" id="hapus-seller-form">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger waves-effect waves-light" href="#">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
