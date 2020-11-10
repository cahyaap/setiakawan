<script type="text/javascript">
    $(document).ready(function($){

        $('.select2').select2();

        var pembelian = $('#tabel-pembelian').DataTable();
        var penjualan = $('#tabel-penjualan').DataTable();

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
            $('#tabel-'+transaksi+'-box').hide();
            $('.transaksi-box').hide();
            $('.transaksi-button').show();
            $(this).hide();
            $('#'+id+'-box').show();
            $('.seller').focus();
        });

        $('.batal-bon-button').click(function(){
            var transaksi = $(this).attr('data-transaksi');
            $('.transaksi-box').hide();
            $('.transaksi-button').show();
            $('#tabel-'+transaksi+'-box').show();
        });

        $('#tambah-data-pembelian').click(function(){
            var _this = $(this);
            _this.hide();
            $('.spinner').show();
            var lastId = _this.attr('last-id');
            var nextId = parseInt(lastId) + 1;
            _this.attr('last-id', nextId);
            $.ajax({
                url: '/pembelian/addRowPembelian',
                data: {
                    row_id: nextId
                },
                success: function(res){
                    $('.spinner').hide();
                    _this.show();
                    $('#row-barang-pembelian').append(res);
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
            $('#daftar-harga-'+idBaris).show();
            $('#daftar-harga-'+idBaris).attr('nama-barang', namaBarang);
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
                $('#nama-barang-'+idBaris+'-alert').hide();
            }else{
                namaBarangAlertCounter++;
                $('#buat-bon-button').attr('disabled', 'disabled');
                $('#nama-barang-'+idBaris+'-alert').show();
            }
        });

        var totalPembelian = 0;
        var totalBeratPembelian = 0;
        var kasPembelian = 0;
        var tfPembelian = 0;
        var dpPembelian = 0;
        var hutangPembelian = 0;
        var sisaPembelian = 0;

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
            totalPembelian = updateTotal('.total-barang', '#total-pembelian');
            totalBeratPembelian = updateTotal('.berat-barang', '#total-berat');
            sisaPembelian = updateSisa(totalPembelian, kasPembelian, tfPembelian, dpPembelian, hutangPembelian);
        });

        $(document).on('keyup', '.berat-barang', function(){
            var _this = $(this);
            var idBaris = splitIdBaris(_this);
            var berat = _this.val();
            var harga = $('#harga-'+idBaris).val();
            $('#total-'+idBaris).val(harga * berat);
            totalPembelian = updateTotal('.total-barang', '#total-pembelian');
            totalBeratPembelian = updateTotal('.berat-barang', '#total-berat');
            sisaPembelian = updateSisa(totalPembelian, kasPembelian, tfPembelian, dpPembelian, hutangPembelian);
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
            kasPembelian = $(this).val();
            sisaPembelian = updateSisa(totalPembelian, kasPembelian, tfPembelian, dpPembelian, hutangPembelian);
        });

        $(document).on('keyup', '#transfer', function(){
            tfPembelian = $(this).val();
            sisaPembelian = updateSisa(totalPembelian, kasPembelian, tfPembelian, dpPembelian, hutangPembelian);
        });

        $(document).on('keyup', '#dp', function(){
            dpPembelian = $(this).val();
            sisaPembelian = updateSisa(totalPembelian, kasPembelian, tfPembelian, dpPembelian, hutangPembelian);
        });
        
        $(document).on('keyup', '#hutang', function(){
            hutangPembelian = $(this).val();
            sisaPembelian = updateSisa(totalPembelian, kasPembelian, tfPembelian, dpPembelian, hutangPembelian);
        });
    });
</script>