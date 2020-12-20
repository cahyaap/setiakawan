<div id="editAbsensi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Edit Absensi</h4>
            </div>
            <form method="POST" id="edit-absensi-form">
            <div class="modal-body">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="edit-tanggal" class="control-label">Tanggal:</label>
                            <input type="text" name="tanggal" id="edit-tanggal" class="form-control" placeholder="Masukkan tanggal absensi disini..." readonly required>
                        </div>
                        <div class="form-group">
                            <label for="edit-nama" class="control-label">Nama:</label>
                            <input type="text" name="name" id="edit-name" class="form-control" placeholder="Masukkan nama karyawan disini..." readonly required>
                        </div>
                        <div class="form-group">
                            <label for="edit-jenis" class="control-label">Absensi:</label>
                            <select name="jenis" id="edit-jenis" class="form-control" required>
                                <option value="">-- Pilih absensi --</option>
                                <option value="h">Hadir</option>
                                <option value="i">Izin</option>
                                <option value="s">Sakit</option>
                                <option value="a">Absen</option>
                                <option value="c">Cuti</option>
                                <option value="l">Libur</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-ket" class="control-label">Keterangan:</label>
                            <textarea name="ket" id="edit-ket" rows="4" class="form-control" placeholder="Masukkan keterangan absensi disini..."></textarea>
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

<div id="detailAbsensi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addOrder" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Laporan Absensi</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center load-content"><span><i class="fa fa-spinner fa-spin"></i></span></div>
                    <div class="col-md-12" id="detail-absensi-data"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div id="daftarAbsensi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addOrder" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Daftar Absensi</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 text-center load-content"><span><i class="fa fa-spinner fa-spin"></i></span></div>
                    <div class="col-md-12" id="daftar-absensi-data"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>