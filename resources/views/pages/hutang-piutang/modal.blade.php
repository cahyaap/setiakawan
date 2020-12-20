<div id="tambahHP" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Tambah Hutang Piutang</h4>
            </div>
            <form method="POST" action="{{ route('hutang-piutang.store') }}">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="seller-id" class="control-label">Seller/Buyer:</label>
                            <select name="seller_id" id="seller-id" class="form-control select2" required>
                                <option value="">-- Pilih nama seller/buyer --</option>
                                @foreach ($sellers as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} - {{ ($item->jenis == 1) ? "Seller" : "Buyer" }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Tipe:</label>
                            <div class="radio">
                                <input type="radio" name="tipe" id="tipe-Hutang" value="Hutang" required>
                                <label for="tipe-Hutang">Hutang</label>
                            </div>
                            <div class="radio">
                                <input type="radio" name="tipe" id="tipe-Piutang" value="Piutang" required>
                                <label for="tipe-Piutang">Piutang</label>
                            </div>
                            <div class="radio">
                                <input type="radio" name="tipe" id="tipe-Bayar" value="Bayar" required>
                                <label for="tipe-Bayar">Bayar</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Jenis:</label>
                            <div class="radio">
                                <input type="radio" name="jenis" id="jenis-Hutang" value="Hutang" required>
                                <label for="jenis-Hutang">Hutang</label>
                            </div>
                            <div class="radio">
                                <input type="radio" name="jenis" id="jenis-DP" value="DP" required>
                                <label for="jenis-DP">DP</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="jumlah" class="control-label">Jumlah:</label>
                            <input type="text" name="jumlah" id="jumlah" class="form-control" placeholder="Masukkan jumlah hutang piutang disini..." required>
                        </div>
                        <div class="form-group">
                            <label for="ket" class="control-label">Keterangan:</label>
                            <textarea name="ket" id="ket" rows="4" class="form-control" placeholder="Masukkan keterangan disini..."></textarea>
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

<div id="editHP" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Edit Hutang Piutang</h4>
            </div>
            <form method="POST" id="edit-hutang-piutang-form">
            <div class="modal-body">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="edit-seller-id" class="control-label">Seller/Buyer:</label>
                            <select name="seller_id" id="edit-seller-id" class="form-control select2" required>
                                <option value="">-- Pilih nama seller/buyer --</option>
                                @foreach ($sellers as $item)
                                <option value="{{ $item->id }}">{{ $item->name }} - {{ ($item->jenis == 1) ? "Seller" : "Buyer" }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Tipe:</label>
                            <div class="radio">
                                <input type="radio" name="tipe" id="edit-tipe-Hutang" value="Hutang" required>
                                <label for="tipe-Hutang">Hutang</label>
                            </div>
                            <div class="radio">
                                <input type="radio" name="tipe" id="edit-tipe-Piutang" value="Piutang" required>
                                <label for="tipe-Piutang">Piutang</label>
                            </div>
                            <div class="radio">
                                <input type="radio" name="tipe" id="edit-tipe-Bayar" value="Bayar" required>
                                <label for="tipe-Bayar">Bayar</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Jenis:</label>
                            <div class="radio">
                                <input type="radio" name="jenis" id="edit-jenis-Hutang" value="Hutang" required>
                                <label for="jenis-Hutang">Hutang</label>
                            </div>
                            <div class="radio">
                                <input type="radio" name="jenis" id="edit-jenis-DP" value="DP" required>
                                <label for="jenis-DP">DP</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="edit-jumlah" class="control-label">Jumlah:</label>
                            <input type="text" name="jumlah" id="edit-jumlah" class="form-control" placeholder="Masukkan jumlah hutang piutang disini..." required>
                        </div>
                        <div class="form-group">
                            <label for="edit-ket" class="control-label">Keterangan:</label>
                            <textarea name="ket" id="edit-ket" rows="4" class="form-control" placeholder="Masukkan keterangan disini..."></textarea>
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

<div id="hapusHP" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addOrder" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Hapus Hutang Piutang</h4>
            </div>
            <div class="modal-body">
                <h5>Hapus <span class="tipe-hp"></span> <strong><span class="seller-name"></span></strong> sebesar <strong><span class="seller-jumlah"></span></strong>?</h5>
            </div>
            <div class="modal-footer">
                <form method="POST" id="hapus-hutang-piutang-form">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger waves-effect waves-light" href="#">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
