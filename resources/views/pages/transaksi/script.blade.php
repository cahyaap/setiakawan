<script type="text/javascript">
    $(document).ready(function($){

        $('.select2').select2();

        var columnsPembelian = [
            { 
                title: "#",
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
                    var detail = "<a class='aksi-btn' href='#detailTransaksi' data-jenis='"+row[6]+"' data-aksi='detail' data-id='"+row[5]+"' data-toggle='modal' data-target='#detailTransaksi'>Detail</a>";
                    var edit = "<a class='aksi-btn' href='#editTransaksi' data-jenis='"+row[6]+"' data-aksi='edit' data-id='"+row[5]+"' data-toggle='modal' data-target='#editTransaksi'>Edit</a>";
                    var hapus = "<a class='aksi-btn' href='#hapusTransaksi' data-jenis='"+row[6]+"' data-aksi='hapus' data-id='"+row[5]+"' data-toggle='modal' data-target='#hapusTransaksi'>Hapus</a>";
                    return detail + " " + edit + " " + hapus
                }
            }
        ];

        var columnsPenjualan = [
            { 
                title: "#",
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
                    var detail = "<a class='aksi-btn' href='#detailTransaksi' data-jenis='"+row[6]+"' data-aksi='detail' data-id='"+row[5]+"' data-toggle='modal' data-target='#detailTransaksi'>Detail</a>";
                    var edit = "<a class='aksi-btn' href='#editTransaksi' data-jenis='"+row[6]+"' data-aksi='edit' data-id='"+row[5]+"' data-toggle='modal' data-target='#editTransaksi'>Edit</a>";
                    var hapus = "<a class='aksi-btn' href='#hapusTransaksi' data-jenis='"+row[6]+"' data-aksi='hapus' data-id='"+row[5]+"' data-toggle='modal' data-target='#hapusTransaksi'>Hapus</a>";
                    return detail + " " + edit + " " + hapus
                }
            }
        ];

        getTableData("{{ route('dataBon') }}", "#tabel-pembelian", columnsPembelian, { jenis: 1 });
        getTableData("{{ route('dataBon') }}", "#tabel-penjualan", columnsPenjualan, { jenis: 2 });

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
                getAksiData(route, '#edit-transaksi-data', { jenis: jenis });
            }
            if(aksi === "hapus"){
                route = "{{ route('transaksi.destroy', 'transaksi_id') }}";
                route = route.replace('transaksi_id', transaksi_id);
                $('.hapus-transaksi-form').attr('action', route);
            }
        });

        $('.tab').click(function(){
            var _this = $(this);
            $('.tab').each(function(){
                $(this).removeClass('tab-active');
            });
            _this.addClass('tab-active');
            $('#tab-pembelian').hide();
            $('#tab-penjualan').hide();
            $('#tab-'+_this.attr('id')).show();
        });

        $('.transaksi-button').click(function(){
            var id = $(this).attr('id');
            var transaksi = $(this).attr('data-transaksi');
            if (id == 3) {
                $('#tambah-transaksi-box').hide();
                $('#tambah-pengeluaran-box').show();
            } else {
                $('#tambah-transaksi-box').hide();
                $('.jenis-transaksi-text').empty();
                $('.jenis-transaksi-text').html(capitalizeFirstLetter(transaksi));
                $('#tambah-transaksi-box').show();
                $('.seller').focus();
                $('#jenis').val(id);
            }
        });

        $('.batal-bon-button').click(function(){
            var transaksi = $(this).attr('data-transaksi');
            $('.transaksi-box').hide();
            $('.transaksi-button-list').show();
        });

        $('#tambah-data-transaksi').click(function(){
            var _this = $(this);
            _this.hide();
            $('.spinner').show();
            var lastId = _this.attr('last-id');
            var nextId = parseInt(lastId) + 1;
            _this.attr('last-id', nextId);
            $.ajax({
                url: '/addRowTransaksi',
                data: {
                    row_id: nextId
                },
                success: function(res){
                    $('.spinner').hide();
                    _this.show();
                    $('#row-barang-transaksi').append(res);
                }
            });
        });

        function splitIdBaris(_this){
            var id = _this.attr('id').split('-');
            var idBaris = id[1];
            return idBaris;
        }

        var namaBarangAlertCounter = 0;
        $(document).on('change', '.nama-barang', function(){
            var _this = $(this);
            var idBaris = splitIdBaris(_this);
            var namaBarang = _this.val();
            $('#harga-'+idBaris).attr('required', 'required');
            $('#kg-'+idBaris).attr('required', 'required');

            // check select from datalist or not
            var obj = $("#nama-barang-"+idBaris).find("option[value='" + namaBarang + "']");
            if(obj != null && obj.length > 0) {
                if (namaBarangAlertCounter > 0) {
                    namaBarangAlertCounter--;
                }
                if (namaBarangAlertCounter == 0){
                    $('#buat-bon-button').removeAttr('disabled');
                }
                var barang_id = obj.data('id');
                $('#barang-id-'+idBaris).val(barang_id);
                $.ajax({
                    url: "{{ route('stok-barang') }}",
                    data: {
                        barang_id: barang_id
                    },
                    success: function(res){
                        $('#nama-barang-'+idBaris+'-alert').removeClass('nama-barang-salah');
                        $('#nama-barang-'+idBaris+'-alert').html("Stok saat ini: <strong>"+res.stok+" kg</strong>");
                    }
                });
                $('#daftar-harga-'+idBaris).html("Lihat daftar harga");
                $('#daftar-harga-'+idBaris).attr('nama-barang', namaBarang);
            }else{
                namaBarangAlertCounter++;
                $('#buat-bon-button').attr('disabled', 'disabled');
                $('#nama-barang-'+idBaris+'-alert').html("Nama barang tidak ada");
                $('#nama-barang-'+idBaris+'-alert').addClass('nama-barang-salah');
                $('#daftar-harga-'+idBaris).empty();
            }
        });

        var total = 0;
        var totalBerat = 0;
        var kas = 0;
        var tf = 0;
        var dp = 0;
        var hutang = 0;
        var sisa = 0;

        function updateTotal(element, result){
            var total = 0;
            var arr = $(element);
            for(var i=0;i<arr.length;i++){
                if(parseInt(arr[i].value))
                total += parseInt(arr[i].value);
            }
            $(result).val(parseInt(total));
            return total;
        }

        $(document).on('keyup', '.harga-barang', function(){
            var _this = $(this);
            var idBaris = splitIdBaris(_this);
            var harga = _this.val();
            var berat = $('#kg-'+idBaris).val();
            $('#total-'+idBaris).val(harga * berat);
            total = updateTotal('.total-barang', '#total-transaksi');
            totalBerat = updateTotal('.berat-barang', '#total-berat');
            sisa = updateSisa(total, kas, tf, dp, hutang);
        });

        $(document).on('keyup', '.berat-barang', function(){
            var _this = $(this);
            var idBaris = splitIdBaris(_this);
            var berat = _this.val();
            var harga = $('#harga-'+idBaris).val();
            $('#total-'+idBaris).val(harga * berat);
            total = updateTotal('.total-barang', '#total-transaksi');
            totalBerat = updateTotal('.berat-barang', '#total-berat');
            sisa = updateSisa(total, kas, tf, dp, hutang);
        });

        $(document).on('click', '.daftar-harga', function(){
            $('#daftar-harga-result').empty();
            var _this = $(this);
            var namaBarang = _this.attr('nama-barang');
            $.ajax({
                url: "{{ route('daftarHarga') }}",
                data: {
                    nama_barang: namaBarang
                },
                success: function(res){
                    $('#daftar-harga-nama-barang').html(" - "+namaBarang)
                    $('#daftar-harga-result').append(res);
                }
            });
        });

        function updateSisa(total, kas, tf, dp, hutang){
            var sisa = total - kas - tf - dp - hutang;
            $('#sisa').val(sisa);
            return sisa;
        }

        $(document).on('keyup', '#kas', function(){
            kas = $(this).val();
            sisa = updateSisa(total, kas, tf, dp, hutang);
        });

        $(document).on('keyup', '#transfer', function(){
            tf = $(this).val();
            sisa = updateSisa(total, kas, tf, dp, hutang);
        });

        $(document).on('keyup', '#dp', function(){
            dp = $(this).val();
            sisa = updateSisa(total, kas, tf, dp, hutang);
        });
        
        $(document).on('keyup', '#hutang', function(){
            hutang = $(this).val();
            sisa = updateSisa(total, kas, tf, dp, hutang);
        });
    });
</script>