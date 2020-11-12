<div class="col-md-12">
    <h3 class="box-title">Tambah Pengeluaran</h3>
    <hr>
    <form id="bon-pengeluaran" method="POST" action="{{ route('transaksi.store') }}">
        @csrf
        <input type="hidden" name="jenis" id="jenis-pengeluaran" value="3">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                
                </div>
                <div class="form-group text-center">
                    <button type="button" class="btn btn-default waves-effect batal-bon-button" data-transaksi="pengeluaran" id="batal-pengeluaran">Batal</button>
                    <button class="btn btn-success waves-effect" id="pengeluaran-button">Tambah Pengeluaran</button>
                </div>
            </div>
        </div>
    </form>
</div>