<div id="tambahKaryawan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Tambah Karyawan</h4>
            </div>
            <form method="POST" action="{{ route('karyawan.store') }}">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nomor_karyawan" class="control-label">Nomor Induk Karyawan:</label>
                            <input type="number" onchange="nomorIndukExist(this)" name="nomor_karyawan" id="nomor-karyawan" class="form-control" placeholder="Masukkan nomor induk karyawan disini..." value="{{ $nomorKaryawan }}" required>
                            <span class="nomor-karyawan-alert"></span>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="control-label">Nama:</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama karyawan disini..." required>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="control-label">Alamat:</label>
                            <textarea name="alamat" id="alamat" rows="4" class="form-control" placeholder="Masukkan alamat karyawan disini..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success waves-effect waves-light" id="tambah-karyawan">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div id="editKaryawan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Edit Karyawan</h4>
            </div>
            <form method="POST" id="edit-karyawan-form">
            <div class="modal-body">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="nomor_karyawan" class="control-label">Nomor Induk Karyawan:</label>
                            <input type="number" name="nomor_karyawan" id="edit-nomor-karyawan" class="form-control" placeholder="Masukkan nomor induk karyawan disini..." readonly required>
                        </div>
                        <div class="form-group">
                            <label for="edit-nama" class="control-label">Nama:</label>
                            <input type="text" name="name" id="edit-name" class="form-control" placeholder="Masukkan nama karyawan disini..." required>
                        </div>
                        <div class="form-group">
                            <label for="edit-alamat" class="control-label">Alamat:</label>
                            <textarea name="alamat" id="edit-alamat" rows="4" class="form-control" placeholder="Masukkan alamat karyawan disini..."></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit-status" class="control-label">Status Karyawan:</label>
                            <select name="status" id="edit-status" class="form-control" required>
                                <option value="">-- Pilih status karyawan --</option>
                                <option value="1">Aktif</option>
                                <option value="2">Tidak Aktif</option>
                            </select>
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

<div id="hapusKaryawan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addOrder" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Hapus Karyawan</h4>
            </div>
            <div class="modal-body">
                <h5>Hapus karyawan <strong><span class="karyawan-name"></span></strong>?</h5>
            </div>
            <div class="modal-footer">
                <form method="POST" id="hapus-karyawan-form">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger waves-effect waves-light" href="#">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
