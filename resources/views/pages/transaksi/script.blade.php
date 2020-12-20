<script type="text/javascript">
    $(document).ready(function($){

        $('.select2').select2();

        var columnsPembelian = [
            { 
                title: "Kode Transaksi",
                className: 'text-center'
            },
            {
                title: "Tanggal",
                className: 'text-center'
            },
            {
                title: "Seller"
            },
            {
                title: "Tonase (kg)",
                className: 'text-right'
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
                    var routePrint = "{{ route('transaksi.print', 'transaksi_id') }}";
                    routePrint = routePrint.replace('transaksi_id', row[6]);
                    var print = "<a class='btn btn-sm btn-success aksi-btn print-btn' alt='Print' title='Print' href='"+routePrint+"' target='_blank' data-jenis='"+row[7]+"' data-aksi='print' data-id='"+row[6]+"'><span><i class='fa fa-print'></i></span></a>";
                    var detail = "<a class='btn btn-sm btn-info aksi-btn detail-btn' alt='Detail' title='Detail' href='#detailTransaksi' data-jenis='"+row[7]+"' data-aksi='detail' data-id='"+row[6]+"' data-toggle='modal' data-target='#detailTransaksi'><span><i class='fa fa-search-plus'></i></span></a>";
                    var edit = "<a class='btn btn-sm btn-warning aksi-btn edit-btn' alt='Edit' title='Edit' href='#editTransaksi' data-jenis='"+row[7]+"' data-aksi='edit' data-id='"+row[6]+"'><span><i class='fa fa-pencil'></i></span></a>";
                    var hapus = "<a class='btn btn-sm btn-danger aksi-btn hapus-btn' alt='Hapus' title='Hapus' href='#hapusTransaksi' data-date='"+row[1]+"' data-seller='"+row[2]+"' data-total='"+row[4]+"' data-jenis='"+row[7]+"' data-aksi='hapus' data-id='"+row[6]+"' data-toggle='modal' data-target='#hapusTransaksi'><span><i class='fa fa-trash'></i></span></a>";
                    return print + " " + detail + " " + edit + " " + hapus
                }
            }
        ];

        var columnsPenjualan = [
            { 
                title: "Kode Transaksi",
                className: 'text-center'
            },
            {
                title: "Tanggal",
                className: 'text-center'
            },
            {
                title: "Seller"
            },
            {
                title: "Tonase (kg)",
                className: 'text-right'
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
                    var routePrint = "{{ route('transaksi.print', 'transaksi_id') }}";
                    routePrint = routePrint.replace('transaksi_id', row[6]);
                    var print = "<a class='btn btn-sm btn-success aksi-btn print-btn' alt='Print' title='Print' href='"+routePrint+"' target='_blank' data-jenis='"+row[7]+"' data-aksi='print' data-id='"+row[6]+"'><span><i class='fa fa-print'></i></span></a>";
                    var detail = "<a class='btn btn-sm btn-info aksi-btn detail-btn' alt='Detail' title='Detail' href='#detailTransaksi' data-jenis='"+row[7]+"' data-aksi='detail' data-id='"+row[6]+"' data-toggle='modal' data-target='#detailTransaksi'><span><i class='fa fa-search-plus'></i></span></a>";
                    var edit = "<a class='btn btn-sm btn-warning aksi-btn edit-btn' alt='Edit' title='Edit' href='#editTransaksi' data-jenis='"+row[7]+"' data-aksi='edit' data-id='"+row[6]+"'><span><i class='fa fa-pencil'></i></span></a>";
                    var hapus = "<a class='btn btn-sm btn-danger aksi-btn hapus-btn' alt='Hapus' title='Hapus' href='#hapusTransaksi' data-date='"+row[1]+"' data-seller='"+row[2]+"' data-total='"+row[4]+"' data-jenis='"+row[7]+"' data-aksi='hapus' data-id='"+row[6]+"' data-toggle='modal' data-target='#hapusTransaksi'><span><i class='fa fa-trash'></i></span></a>";
                    return print + " " + detail + " " + edit + " " + hapus
                }
            }
        ];

        var columnsPengeluaran = [
            { 
                title: "#",
                className: 'text-center'
            },
            {
                title: "Tanggal",
                className: 'text-center'
            },
            {
                title: "Name"
            },
            {
                title: "Nominal",
                className: 'text-right'
            },
            {
                title: "Keterangan"
            },
            {
                title: "Aksi",
                className: 'text-center',
                render: function(data, type, row) {
                    var edit = "<a class='btn btn-sm btn-warning edit-btn edit-pengeluaran' alt='Edit' title='Edit' data-toggle='modal' data-target='#editPengeluaran' href='#editPengeluaran' data-aksi='edit' data-id='"+row[5]+"' data-name='"+row[2]+"' data-nominal='"+row[3]+"' data-ket='"+row[4]+"'><span><i class='fa fa-pencil'></i></span></a>";
                    var hapus = "<a class='btn btn-sm btn-danger hapus-btn hapus-pengeluaran' alt='Hapus' title='Hapus' href='#hapusPengeluaran' data-aksi='hapus' data-id='"+row[5]+"' data-name='"+row[2]+"' data-nominal='"+row[3]+"' data-ket='"+row[4]+"' data-toggle='modal' data-target='#hapusPengeluaran'><span><i class='fa fa-trash'></i></span></a>";
                    return edit + " " + hapus
                }
            }
        ];

        getTableData("{{ route('dataBon') }}", "#tabel-pembelian", columnsPembelian, { jenis: 1 }, [[0, "desc"]]);
        getTableData("{{ route('dataBon') }}", "#tabel-penjualan", columnsPenjualan, { jenis: 2 }, [[0, "desc"]]);
        getTableData("{{ route('pengeluaran.index') }}", "#tabel-pengeluaran", columnsPengeluaran);

        $(document).on('click', '.aksi-btn', function(){
            var _this = $(this);
            var transaksi_id = _this.data('id');
            var jenis = _this.data('jenis');
            var aksi = _this.data('aksi');
            var route = "";
            if(aksi === "detail"){
                route = "{{ route('transaksi.show', 'transaksi_id') }}";
                route = route.replace('transaksi_id', transaksi_id);
                getAksiData(route, '#detail-transaksi-data', { jenis: jenis });
            }
            if(aksi === "edit"){
                route = "{{ route('transaksi.edit', 'transaksi_id') }}";
                route = route.replace('transaksi_id', transaksi_id);
                getBon(route, "#tambah-transaksi-box", { jenis: jenis, transaksi_id: transaksi_id });
                getHutangBySeller($('#seller').val());
            }
            if(aksi === "hapus"){
                route = "{{ route('transaksi.destroy', 'transaksi_id') }}";
                route = route.replace('transaksi_id', transaksi_id);
                $('.hapus-transaksi-form').attr('action', route);
                $('#seller-hapus, #date-hapus, #total-hapus').empty();
                $('#seller-hapus').html(_this.data('seller'));
                $('#date-hapus').html(_this.data('date'));
                $('#total-hapus').html(_this.data('total'));
            }
        });

        $(document).on('click', '.edit-pengeluaran', function(){
            var _this = $(this);
            var id = _this.data('id');
            var route = "{{ route('pengeluaran.update', 'pengeluaran_id') }}";
            route = route.replace('pengeluaran_id', id);
            $('#update-bon-pengeluaran').attr('action', route);
            $('#edit-name').val(_this.data('name'));
            $('#edit-nominal').val(_this.data('nominal'));
            $('#edit-ket').val(_this.data('ket'));
        });

        $(document).on('click', '.hapus-pengeluaran', function(){
            var _this = $(this);
            var id = _this.data('id');
            var route = "{{ route('pengeluaran.destroy', 'pengeluaran_id') }}";
            route = route.replace('pengeluaran_id', id);
            $('#delete-bon-pengeluaran').attr('action', route);
            $('#delete-name-pengeluaran').html(_this.data('name'));
            $('#delete-nominal-pengeluaran').html(_this.data('nominal'));
            $('#delete-ket-pengeluaran').html(_this.data('ket'));
        });

        $('.tab').click(function(){
            var _this = $(this);
            $('.tab').each(function(){
                $(this).removeClass('tab-active');
            });
            _this.addClass('tab-active');
            $('#tab-pembelian').hide();
            $('#tab-penjualan').hide();
            $('#tab-pengeluaran').hide();
            $('#tab-'+_this.attr('id')).show();
        });

        $('.transaksi-button').click(function(){
            var id = $(this).attr('id');
            var transaksi = $(this).attr('data-transaksi');
            getBon("{{ route('transaksi.create') }}", "#tambah-transaksi-box", { jenis: id });
        });

        $(document).on('click', '.batal-bon-button', function(){
            removeBon('.bon-transaksi');
            $('.transaksi-box').hide();
        });

        $(document).on('keyup', '#nominal, #edit-nominal', function(){
            $(this).val(function(index, value) {
                return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            });
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
            $(this).val(function(index, value) {
                return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            });
            var _this = $(this);
            var idBaris = splitIdBaris(_this.attr('id'));
            var harga = Number(_this.val().replace(/\,/g,''));
            var berat = $('#kg-'+idBaris).val();
            $('#total-'+idBaris).val(harga * berat);
            $('#view-total-'+idBaris).val(addCommas(harga * berat));
            updateTotal('.total-barang', '#total-transaksi', '#view-total-transaksi');
            updateTotal('.berat-barang', '#total-berat', '#view-total-berat');
            updateSisa();
        });

        $(document).on('keyup', '.berat-barang', function(){
            var _this = $(this);
            var idBaris = splitIdBaris(_this.attr('id'));
            var berat = _this.val();
            var harga = Number($('#harga-'+idBaris).val().replace(/\,/g,''));
            $('#total-'+idBaris).val(harga * berat);
            $('#view-total-'+idBaris).val(addCommas(harga * berat));
            updateTotal('.total-barang', '#total-transaksi', '#view-total-transaksi');
            updateTotal('.berat-barang', '#total-berat', '#view-total-berat');
            updateSisa();
        });

        $(document).on('click', '.daftar-harga', function(){
            $('#daftar-harga-result').empty();
            var _this = $(this);
            var namaBarang = _this.attr('nama-barang');
            var jenis = $('#jenis').val();
            $.ajax({
                url: "{{ route('daftar-harga') }}",
                data: {
                    nama_barang: namaBarang,
                    jenis: jenis
                },
                success: function(res){
                    $('#daftar-harga-nama-barang').html(" - "+namaBarang)
                    $('#daftar-harga-result').append(res);
                }
            });
        });

        $(document).on('keyup', '#kas, #transfer, #dp, #hutang, #transaksi', function(){
            $(this).val(function(index, value) {
                return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            });
            updateSisa();
        });
    });
</script>