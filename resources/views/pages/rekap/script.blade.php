<script type="text/javascript">
    
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    
    $(document).ready(function(){
        function weekCount(year, month_number, startDayOfWeek) {
            // month_number is in the range 1..12

            // Get the first day of week week day (0: Sunday, 1: Monday, ...)
            var firstDayOfWeek = startDayOfWeek || 0;

            var firstOfMonth = new Date(year, month_number-1, 1);
            var lastOfMonth = new Date(year, month_number, 0);
            var numberOfDaysInMonth = lastOfMonth.getDate();
            var firstWeekDay = (firstOfMonth.getDay() - firstDayOfWeek + 7) % 7;

            var used = firstWeekDay + numberOfDaysInMonth;

            return Math.ceil( used / 7);
        }

        function updateTitle(params)
        {
            if(params['rekap'] == "harian"){
                var tanggal = new Date(params['tanggal']);
                var day = dayList[tanggal.getDay()];
                var date = tanggal.getDate();
                var month = monthList[tanggal.getMonth()+1];
                var year = tanggal.getFullYear();
                $('#jenis-rekap').html((params['jenis'] == 1 ? "PEMBELIAN" : "PENJUALAN")+" "+params['rekap']+" - "+day+", "+date+" "+month+" "+year);
            }
            if(params['rekap'] == "mingguan"){
                var month = monthList[params['bulan_m']];
                $('#jenis-rekap').html((params['jenis'] == 1 ? "PEMBELIAN" : "PENJUALAN")+" "+params['rekap']+" - "+"Minggu ke-"+params['minggu']+" "+month+" "+params['tahun_m']);
            }
            if(params['rekap'] == "bulanan"){
                var month = monthList[params['bulan_b']];
                $('#jenis-rekap').html((params['jenis'] == 1 ? "PEMBELIAN" : "PENJUALAN")+" "+params['rekap']+" - "+month+" "+params['tahun_b']);
            }
        }

        function getRekap(element, params = null){
            $(element).empty();
            $('.load-content').show();
            $.ajax({
                url: (params['jenis'] == "1") ?  "{{ route('get-rekap') }}" : "{{ route('get-rekap-penjualan') }}",
                data: params,
                success: function(res){
                    $('#jenis-rekap').html(params['jenis'] == 1 ? "PEMBELIAN" : "PENJUALAN");
                    $('.load-content').hide();
                    $(element).append(res);
                    $('#tabel-rekap').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'excel'
                        ]
                    });
                }
            });
        }

        var dayList = new Array(7);
        dayList[0] = "Minggu";
        dayList[1] = "Senin";
        dayList[2] = "Selasa";
        dayList[3] = "Rabu";
        dayList[4] = "Kamis";
        dayList[5] = "Jum'at";
        dayList[6] = "Sabtu";

        var monthList = new Array(12);
        monthList[1] = "Januari";
        monthList[2] = "Februari";
        monthList[3] = "Maret";
        monthList[4] = "April";
        monthList[5] = "Mei";
        monthList[6] = "Juni";
        monthList[7] = "Juli";
        monthList[8] = "Agustus";
        monthList[9] = "September";
        monthList[10] = "Oktober";
        monthList[11] = "November";
        monthList[12] = "Desember";

        var params = {};
        params['jenis'] = $('#jenis').val();
        params['rekap'] = $('#rekap').val();
        params['tanggal'] = $('#tanggal').val();
        params['minggu'] = $('#minggu').val();
        params['bulan_m'] = $('#bulan-mingguan').val();
        params['tahun_m'] = $('#tahun-mingguan').val();
        params['bulan_b'] = $('#bulan-bulanan').val();
        params['tahun_b'] = $('#tahun-bulanan').val();

        // getTableData("{{ route('get-rekap') }}", "#tabel-rekap", columns, params, [[0, "asc"]]);
        getRekap("#rekap-container", params);

        $('#jenis-rekap').html(params['jenis'] == 1 ? "PEMBELIAN" : "PENJUALAN");

        $('#form-filter').on('submit', function(e){
            e.preventDefault();
            getRekap("#rekap-container", params);
        });

        $('#rekap').on('change', function(){
            params['rekap'] = $(this).val();
            $('.rekap-filter').hide();
            $('#rekap-'+$(this).val()).show();
            // getRekap("#rekap-container", params);
        });

        $('#jenis').on('change', function(){
            params['jenis'] = $(this).val();
            // getRekap("#rekap-container", params);
        });

        // rekap harian -> jenis, tanggal
        $('#tanggal').on('change', function(){
            params['tanggal'] = $(this).val();
            if(params['tanggal'] !== ""){
                // getRekap("#rekap-container", params);
            }
        });

        // rekap mingguan -> jenis, bulan, tahun, minggu
        $('#bulan-mingguan').on('change', function(){
            params['bulan_m'] = $(this).val();
            // getRekap("#rekap-container", params);
        });

        $('#tahun-mingguan').on('change', function(){
            params['tahun_m'] = $(this).val();
            // getRekap("#rekap-container", params);
        });

        $('#minggu').on('change', function(){
            params['minggu'] = $(this).val();
            // getRekap("#rekap-container", params);
        });

        // rekap bulanan -> jenis, bulan, tahun
        $('#bulan-bulanan').on('change', function(){
            params['bulan_b'] = $(this).val();
            // getRekap("#rekap-container", params);
        });

        $('#tahun-bulanan').on('change', function(){
            params['tahun_b'] = $(this).val();
            // getRekap("#rekap-container", params);
        });

        $(document).on('keyup', '.hpp', function(){
            $(this).val(function(index, value) {
                return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            });
            var _this = $(this);
            var hpp = Number(_this.val().replace(/\,/g,''));
            var id = _this.data('id');
            var laba = updateLaba(id);
            var color = "success";
            if(laba < 0){
                color = "danger";
            }
            $('#temp-laba-'+id).val(laba);
            $('#laba-'+id).html("<span class='btn btn-" + color + "'>" + addCommas(laba) + "</span>");
        });

        $(document).on('keyup', '.kurleb-tonase', function(){
            var _this = $(this);
            var id = _this.data('id');
            var laba = updateLaba(id);
            var color = "success";
            if(laba < 0){
                color = "danger";
            }
            $('#temp-laba-'+id).val(laba);
            $('#laba-'+id).html("<span class='btn btn-" + color + "'>" + addCommas(laba) + "</span>");
            var total_laba = updateTotalLaba();
            $('#total-laba').html("<span class='btn btn-success'>" + addCommas(total_laba) + "</span>");
        });

        function updateLaba(id){
            var harga = $('#harga-'+id).val();
            var berat = $('#berat-'+id).val();
            var total = harga * berat;
            var kurleb = ($('#kurleb-tonase-'+id).val() !== "") ? $('#kurleb-tonase-'+id).val() * harga : 0;
            var hpp = Number($('#hpp-'+id).val().replace(/\,/g,''));
            var laba = total - hpp + kurleb;
            return laba;
        }

        function updateTotalLaba(){
            var total = 0;
            $('.hpp').each(function(){
                var id = $(this).data('id');
                var laba = $('#temp-laba-'+id).val();
                total += parseInt(laba);
            });
            return total;
        }

        $(document).on('click', '.simpan', function(){
            var _this = $(this);
            var id = _this.data('id');
            var harga = $('#harga-'+id).val();
            var hpp = Number($('#hpp-'+id).val().replace(/\,/g,''));
            var kurleb = ($('#kurleb-tonase-'+id).val() !== "") ? $('#kurleb-tonase-'+id).val() : 0;
            var potongan = ($('#potongan-'+id).val() !== "") ? $('#potongan-'+id).val() : 0;
            var retur = ($('#retur-'+id).val() !== "") ? $('#retur-'+id).val() : 0;
            var keterangan = $('#keterangan-'+id).val();
            var laba = updateLaba(id);

            $('#simpan-'+id).hide();
            $('#spin-'+id).show();
            $.ajax({
                url: "{{ route('rekap.store') }}",
                type: "POST",
                data: {
                    _token: CSRF_TOKEN,
                    id: id,
                    hpp: hpp,
                    kurleb: kurleb,
                    potongan: potongan,
                    retur: retur,
                    laba: laba,
                    keterangan: keterangan
                },
                success: function(res){
                    $('#spin-'+id).hide();
                    $('#simpan-'+id).show();
                    $('#simpan-'+id).removeClass('btn-warning');
                    $('#simpan-'+id).addClass('btn-info');
                    console.log(res);
                },
                error: function(err){
                    console.log(err);
                }
            });
        });

    });
</script>