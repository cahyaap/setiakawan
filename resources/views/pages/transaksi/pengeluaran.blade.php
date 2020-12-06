<div class="col-md-12">
    <h3 class="box-title"><span class="jenis-transaksi-text"></h3>
    <hr>
    <form id="bon-pengeluaran" method="POST" action="{{ route('transaksi.store') }}">
        @csrf
        <input type="hidden" name="jenis" id="jenis-pengeluaran" value="3">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="kas">Nominal</label>
                    <input type="number" name="nominal" id="nominal" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="ket">Keterangan</label>
                    <input type="text" list="list-ket" name="ket" id="ket" class="form-control">
                    <datalist id="list-ket">

                    </datalist>
                </div>
                <div class="form-group text-center">
                    <button type="button" class="btn btn-default waves-effect batal-bon-button" data-transaksi="pengeluaran" id="batal-pengeluaran">Batal</button>
                    <button class="btn btn-success waves-effect" id="pengeluaran-button">Tambah Pengeluaran</button>
                </div>
            </div>
        </div>
    </form>
</div>