<div id="tambahHarga" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Tambah Harga</h4>
            </div>
            <form method="POST" action="{{ route('harga.store') }}">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="barang_id" class="control-label">Barang:</label>
                            <select name="barang_id" id="barang-id" class="form-control select2" required>
                                <option value="">-- Pilih barang --</option>
                                @foreach ($barangs as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="beli" class="control-label">Beli:</label>
                            <input type="number" min="0" name="beli" id="beli" class="form-control"
                                placeholder="Masukkan harga beli barang disini..." required>
                        </div>
                        <div class="form-group">
                            <label for="jual" class="control-label">Jual:</label>
                            <input type="number" min="0" name="jual" id="jual" class="form-control"
                                placeholder="Masukkan harga jual barang disini..." required>
                        </div>
                        <div class="form-group">
                            <label for="ket" class="control-label">Keterangan:</label>
                            <textarea name="ket" id="ket" class="form-control"
                                placeholder="Masukkan keterangan harga disini..."></textarea>
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

<div id="editHarga" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Edit Harga</h4>
            </div>
            <form method="POST" id="edit-harga-form">
            <div class="modal-body">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="barang_id" class="control-label">Barang:</label>
                            <select name="barang_id" id="edit-barang-id" class="form-control" required>
                                <option value="">-- Pilih barang --</option>
                                @foreach ($barangs as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="beli" class="control-label">Beli:</label>
                            <input type="number" min="0" name="beli" id="edit-beli" class="form-control"
                                placeholder="Masukkan harga beli barang disini..." required>
                        </div>
                        <div class="form-group">
                            <label for="jual" class="control-label">Jual:</label>
                            <input type="number" min="0" name="jual" id="edit-jual" class="form-control"
                                placeholder="Masukkan harga jual barang disini..." required>
                        </div>
                        <div class="form-group">
                            <label for="ket" class="control-label">Keterangan:</label>
                            <textarea name="ket" id="edit-ket" class="form-control"
                                placeholder="Masukkan keterangan harga disini..."></textarea>
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

<div id="hapusHarga" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addOrder" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Hapus Harga</h4>
            </div>
            <div class="modal-body">
                <h5>Hapus harga <strong><span class="barang-name"></span></strong>?</h5>
            </div>
            <div class="modal-footer">
                <form method="POST" id="hapus-harga-form">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger waves-effect waves-light" href="#">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
