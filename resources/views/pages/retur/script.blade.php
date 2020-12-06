<script type="text/javascript">
    $(document).ready(function($){

        var columns = [
            {
                title: "Tanggal Retur",
                className: 'text-center'
            },
            { 
                title: "Kode Retur",
                className: 'text-center'
            },
            { 
                title: "Kode Transaksi",
                className: 'text-center',
                render: function(data, type, row){
                    return "<a class='aksi-btn detail-btn' alt='Detail' title='Detail' href='#detailTransaksi' data-aksi='detail-transaksi' data-transaksi-id='"+row[6][1]+"' data-jenis='"+row[6][2]+"' data-toggle='modal' data-target='#detailTransaksi'>"+row[2]+"</a>";
                }
            },
            {
                title: "Seller"
            },
            {
                title: "Total",
                className: 'text-right'
            },
            {
                title: "Keterangan"
            },
            {
                title: "Aksi",
                className: 'text-center',
                render: function(data, type, row) {
                    var detail = "<a class='btn btn-sm btn-info aksi-btn detail-btn' alt='Detail' title='Detail' href='#detailRetur' data-aksi='detail' data-id='"+row[6][0]+"' data-transaksi-id='"+row[6][1]+"' data-jenis='"+row[6][2]+"' data-toggle='modal' data-target='#detailRetur'><span><i class='fa fa-search-plus'></i></span></a>";
                    var edit = "<a class='btn btn-sm btn-warning aksi-btn edit-btn' alt='Edit' title='Edit' href='#editRetur' data-aksi='edit' data-id='"+row[6][0]+"' data-transaksi-id='"+row[6][1]+"' data-jenis='"+row[6][2]+"'><span><i class='fa fa-pencil'></i></span></a>";
                    var hapus = "<a class='btn btn-sm btn-danger aksi-btn hapus-btn' alt='Hapus' title='Hapus' href='#hapusRetur' data-date='"+row[1]+"' data-seller='"+row[2]+"' data-total='"+row[3]+"' data-aksi='hapus' data-id='"+row[6][0]+"' data-transaksi-id='"+row[6][1]+"' data-jenis='"+row[6][2]+"' data-kode='"+row[0]+"' data-toggle='modal' data-target='#hapusRetur'><span><i class='fa fa-trash'></i></span></a>";
                    return detail + " " + edit + " " + hapus
                }
            }
        ];

        getTableData("{{ route('get-retur') }}", "#tabel-retur", columns, null, [[1, "desc"]]);

        $(document).on('click', '.aksi-btn', function(){
            var _this = $(this);
            var retur_id = _this.data('id');
            var transaksi_id = _this.data('transaksi-id');
            var jenis = _this.data('jenis');
            var aksi = _this.data('aksi');
            var route = "";
            if(aksi === "detail-transaksi"){
                route = "{{ route('transaksi.show', 'transaksi_id') }}";
                route = route.replace('transaksi_id', transaksi_id);
                getAksiData(route, '#detail-transaksi-data', { jenis: jenis });
            }
            if(aksi === "detail"){
                route = "{{ route('retur.show', 'retur_id') }}";
                route = route.replace('retur_id', retur_id);
                getAksiData(route, '#detail-retur-data', { jenis: jenis });
            }
            if(aksi === "edit"){
                route = "{{ route('retur.edit', 'retur_id') }}";
                route = route.replace('retur_id', retur_id);
                getBon(route, "#tambah-transaksi-box", { jenis: jenis, transaksi_id: transaksi_id });
            }
            if(aksi === "hapus"){
                route = "{{ route('retur.destroy', 'retur_id') }}";
                route = route.replace('retur_id', retur_id);
                $('.hapus-retur-form').attr('action', route);
                $('#retur-hapus, #date-hapus, #total-hapus').empty();
                $('#retur-hapus').html(_this.data('kode'));
                $('#date-hapus').html(_this.data('date'));
                $('#total-hapus').html(_this.data('total'));
            }
        });

        $('.transaksi-button').click(function(){
            var id = $(this).attr('id');
            getBon("{{ route('retur.create') }}", "#tambah-transaksi-box", { jenis: id });
        });

        $(document).on('click', '.batal-bon-button', function(){
            removeBon('.bon-transaksi');
            $('.transaksi-box').hide();
        });

        var namaBarangAlertCounter = 0;
        $(document).on('change', '.nama-barang', function(){
            var _this = $(this);
            var idBaris = splitIdBaris(_this.attr('id'));
            var namaBarang = _this.val();
            $('#harga-'+idBaris).attr('required', 'required');
            $('#kg-'+idBaris).attr('required', 'required');

            // check select from datalist or not
            var obj = $("#nama-barang-"+idBaris).find("option[value='" + namaBarang + "']");
            namaBarangAlertCounter = bonInputCheck('#buat-bon-button', idBaris, obj, namaBarang, namaBarangAlertCounter);
        });

        $(document).on('keyup', '.harga-barang', function(){
            var _this = $(this);
            var idBaris = splitIdBaris(_this.attr('id'));
            var harga = _this.val();
            var berat = $('#kg-'+idBaris).val();
            $('#total-'+idBaris).val(harga * berat);
            updateTotal('.total-barang', '#total-transaksi');
            updateTotal('.berat-barang', '#total-berat');
        });

        $(document).on('keyup', '.berat-barang', function(){
            var _this = $(this);
            var idBaris = splitIdBaris(_this.attr('id'));
            var berat = _this.val();
            var harga = $('#harga-'+idBaris).val();
            $('#total-'+idBaris).val(harga * berat);
            updateTotal('.total-barang', '#total-transaksi');
            updateTotal('.berat-barang', '#total-berat');
        });

        $(document).on('click', '.daftar-harga', function(){
            $('#daftar-harga-result').empty();
            var _this = $(this);
            var namaBarang = _this.attr('nama-barang');
            $.ajax({
                url: "{{ route('daftar-harga') }}",
                data: {
                    nama_barang: namaBarang
                },
                success: function(res){
                    $('#daftar-harga-nama-barang').html(" - "+namaBarang)
                    $('#daftar-harga-result').append(res);
                }
            });
        });
    });
</script>