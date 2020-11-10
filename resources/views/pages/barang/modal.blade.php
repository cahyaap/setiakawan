<div id="tambahBarang" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Tambah Barang</h4>
            </div>
            <form method="POST" action="{{ route('barang.store') }}">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="kategori_id" class="control-label">Kategori:</label>
                            <select name="kategori_id" id="kategori-id" class="form-control select2" required>
                                <option value="">-- Pilih kategori barang --</option>
                                @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="control-label">Nama:</label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Masukkan nama barang disini..." required>
                        </div>
                        <div class="form-group">
                            <label for="kode" class="control-label">Kode:</label>
                            <input type="text" name="kode" id="kode" class="form-control"
                                placeholder="Masukkan kode barang disini..." required>
                        </div>
                        <div class="form-group">
                            <label for="ket" class="control-label">Keterangan:</label>
                            <textarea name="ket" id="ket" class="form-control"
                                placeholder="Masukkan keterangan barang disini..."></textarea>
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

<div id="editBarang" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Edit Barang</h4>
            </div>
            <form method="POST" id="edit-barang-form">
            <div class="modal-body">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="kategori_id" class="control-label">Kategori:</label>
                            <select name="kategori_id" id="edit-kategori-id" class="form-control select2" required>
                                <option value="">-- Pilih kategori barang --</option>
                                @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="control-label">Nama:</label>
                            <input type="text" name="name" id="edit-name" class="form-control"
                                placeholder="Masukkan nama barang disini..." required>
                        </div>
                        <div class="form-group">
                            <label for="kode" class="control-label">Kode:</label>
                            <input type="text" name="kode" id="edit-kode" class="form-control"
                                placeholder="Masukkan kode barang disini..." required>
                        </div>
                        <div class="form-group">
                            <label for="ket" class="control-label">Keterangan:</label>
                            <textarea name="ket" id="edit-ket" class="form-control"
                                placeholder="Masukkan keterangan barang disini..."></textarea>
                        </div>
                        <div class="form-group" id="update-alert" style="display: none;">
                            <small style="font-style: italic; color: red;">*) Data sedang digunakan, jika anda meng-update data ini maka data-data yang berhubungan yang sudah tersimpan sebelumnya akan ikut terupdate, seperti daftar harga, transaksi, dan lainnya</small>
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

<div id="hapusBarang" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addOrder" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Hapus Barang</h4>
            </div>
            <div class="modal-body">
                <h5>Hapus barang <strong><span class="barang-name"></span></strong>?</h5>
            </div>
            <div class="modal-footer">
                <form method="POST" id="hapus-barang-form">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger waves-effect waves-light" href="#">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
