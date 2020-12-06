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
                            <label for="seller_id" class="control-label">Seller:</label>
                            <select name="seller_id" id="seller-id" class="form-control select2" required>
                                <option value="">-- Pilih nama seller --</option>
                                @foreach ($sellers as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tipe" class="control-label">Tipe:</label>
                            <select name="tipe" id="tipe" class="form-control" required>
                                <option value="">-- Pilih tipe --</option>
                                {{-- <option value="DP">DP</option> --}}
                                <option value="Hutang">Hutang</option>
                                <option value="Piutang">Piutang</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah" class="control-label">Jumlah:</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control" placeholder="Masukkan jumlah hutang piutang disini..." required>
                            <input type="hidden" name="jenis" id="jenis" class="form-control" value="Kredit" required>
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
                            <label for="edit-seller-id" class="control-label">Seller:</label>
                            <select name="seller_id" id="edit-seller-id" class="form-control select2" required>
                                <option value="">-- Pilih nama seller --</option>
                                @foreach ($sellers as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="form-group">
                            <label for="edit-tipe" class="control-label">Tipe:</label>
                            <select name="tipe" id="edit-tipe" class="form-control" required>
                                <option value="">-- Pilih tipe --</option>
                                {{-- <option value="DP">DP</option> --}}
                                <option value="Hutang">Hutang</option>
                                <option value="Piutang">Piutang</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-jumlah" class="control-label">Jumlah:</label>
                            <input type="number" name="jumlah" id="edit-jumlah" class="form-control" placeholder="Masukkan jumlah hutang piutang disini..." required>
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
