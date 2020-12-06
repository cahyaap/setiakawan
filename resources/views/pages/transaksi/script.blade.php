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
                    var print = "<a class='btn btn-sm btn-success aksi-btn print-btn' alt='Print' title='Print' href='#printTransaksi' data-jenis='"+row[6]+"' data-aksi='print' data-id='"+row[5]+"'><span><i class='fa fa-print'></i></span></a>";
                    var detail = "<a class='btn btn-sm btn-info aksi-btn detail-btn' alt='Detail' title='Detail' href='#detailTransaksi' data-jenis='"+row[6]+"' data-aksi='detail' data-id='"+row[5]+"' data-toggle='modal' data-target='#detailTransaksi'><span><i class='fa fa-search-plus'></i></span></a>";
                    var edit = "<a class='btn btn-sm btn-warning aksi-btn edit-btn' alt='Edit' title='Edit' href='#editTransaksi' data-jenis='"+row[6]+"' data-aksi='edit' data-id='"+row[5]+"'><span><i class='fa fa-pencil'></i></span></a>";
                    var hapus = "<a class='btn btn-sm btn-danger aksi-btn hapus-btn' alt='Hapus' title='Hapus' href='#hapusTransaksi' data-date='"+row[1]+"' data-seller='"+row[2]+"' data-total='"+row[3]+"' data-jenis='"+row[6]+"' data-aksi='hapus' data-id='"+row[5]+"' data-toggle='modal' data-target='#hapusTransaksi'><span><i class='fa fa-trash'></i></span></a>";
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
                    var print = "<a class='btn btn-sm btn-success aksi-btn print-btn' alt='Print' title='Print' href='#printTransaksi' data-jenis='"+row[6]+"' data-aksi='print' data-id='"+row[5]+"'><span><i class='fa fa-print'></i></span></a>";
                    var detail = "<a class='btn btn-sm btn-info aksi-btn detail-btn' alt='Detail' title='Detail' href='#detailTransaksi' data-jenis='"+row[6]+"' data-aksi='detail' data-id='"+row[5]+"' data-toggle='modal' data-target='#detailTransaksi'><span><i class='fa fa-search-plus'></i></span></a>";
                    var edit = "<a class='btn btn-sm btn-warning aksi-btn edit-btn' alt='Edit' title='Edit' href='#editTransaksi' data-jenis='"+row[6]+"' data-aksi='edit' data-id='"+row[5]+"'><span><i class='fa fa-pencil'></i></span></a>";
                    var hapus = "<a class='btn btn-sm btn-danger aksi-btn hapus-btn' alt='Hapus' title='Hapus' href='#hapusTransaksi' data-date='"+row[1]+"' data-seller='"+row[2]+"' data-total='"+row[3]+"' data-jenis='"+row[6]+"' data-aksi='hapus' data-id='"+row[5]+"' data-toggle='modal' data-target='#hapusTransaksi'><span><i class='fa fa-trash'></i></span></a>";
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
                    var hapus = "<a class='btn btn-sm btn-danger hapus-btn hapus-pengeluaran' alt='Hapus' title='Hapus' href='#hapusPengeluaran' data-nominal='"+row[3]+"' data-aksi='hapus' data-id='"+row[5]+"' data-name='"+row[2]+"' data-nominal='"+row[3]+"' data-ket='"+row[4]+"' data-toggle='modal' data-target='#hapusPengeluaran'><span><i class='fa fa-trash'></i></span></a>";
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
            $('#edit-nominal').val(_this.data('nominal').replace(/,/g, ''));
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
            // $('.seller').focus();
            // $('#jenis').val(id);
            // if (id == 3) {
            //     $('#tambah-transaksi-box').hide();
            //     $('#tambah-pengeluaran-box').show();
            // } else {
            //     $('#tambah-transaksi-box').hide();
            //     $('.jenis-transaksi-text').empty();
            //     $('.jenis-transaksi-text').html(capitalizeFirstLetter(transaksi));
            //     $('#tambah-transaksi-box').show();
            //     $('.seller').focus();
            //     $('#jenis').val(id);
            // }
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
            // if(obj != null && obj.length > 0) {
            //     if (namaBarangAlertCounter > 0) {
            //         namaBarangAlertCounter--;
            //     }
            //     if (namaBarangAlertCounter == 0){
            //         $('#buat-bon-button').removeAttr('disabled');
            //     }
            //     var barang_id = obj.data('id');
            //     $('#barang-id-'+idBaris).val(barang_id);
            //     $.ajax({
            //         url: "{{ route('stok-barang') }}",
            //         data: {
            //             barang_id: barang_id
            //         },
            //         success: function(res){
            //             $('#nama-barang-'+idBaris+'-alert').removeClass('nama-barang-salah');
            //             $('#nama-barang-'+idBaris+'-alert').html("Stok saat ini: <strong>"+res.stok+" kg</strong>");
            //         }
            //     });
            //     $('#daftar-harga-'+idBaris).html("Lihat daftar harga");
            //     $('#daftar-harga-'+idBaris).attr('nama-barang', namaBarang);
            // }else{
            //     namaBarangAlertCounter++;
            //     $('#buat-bon-button').attr('disabled', 'disabled');
            //     $('#nama-barang-'+idBaris+'-alert').html("Nama barang tidak ada");
            //     $('#nama-barang-'+idBaris+'-alert').addClass('nama-barang-salah');
            //     $('#daftar-harga-'+idBaris).empty();
            // }
        });

        $(document).on('keyup', '.harga-barang', function(){
            var _this = $(this);
            var idBaris = splitIdBaris(_this.attr('id'));
            var harga = _this.val();
            var berat = $('#kg-'+idBaris).val();
            $('#total-'+idBaris).val(harga * berat);
            updateTotal('.total-barang', '#total-transaksi');
            updateTotal('.berat-barang', '#total-berat');
            updateSisa();
        });

        $(document).on('keyup', '.berat-barang', function(){
            var _this = $(this);
            var idBaris = splitIdBaris(_this.attr('id'));
            var berat = _this.val();
            var harga = $('#harga-'+idBaris).val();
            $('#total-'+idBaris).val(harga * berat);
            updateTotal('.total-barang', '#total-transaksi');
            updateTotal('.berat-barang', '#total-berat');
            updateSisa();
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

        $(document).on('keyup', '#kas, #transfer, #dp, #hutang', function(){
            updateSisa();
        });
    });
</script>