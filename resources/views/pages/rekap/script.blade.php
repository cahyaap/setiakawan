<script type="text/javascript">
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
                url: "{{ route('get-rekap') }}",
                data: params,
                success: function(res){
                    $('#jenis-rekap').html(params['jenis'] == 1 ? "PEMBELIAN" : "PENJUALAN");
                    $('.load-content').hide();
                    $(element).append(res);
                    $('#tabel-rekap').DataTable();
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

        $('#rekap').on('change', function(){
            params['rekap'] = $(this).val();
            $('.rekap-filter').hide();
            $('#rekap-'+$(this).val()).show();
            getRekap("#rekap-container", params);
        });

        $('#jenis').on('change', function(){
            params['jenis'] = $(this).val();
            getRekap("#rekap-container", params);
        });

        // rekap harian -> jenis, tanggal
        $('#tanggal').on('change', function(){
            params['tanggal'] = $(this).val();
            getRekap("#rekap-container", params);
        });

        // rekap mingguan -> jenis, bulan, tahun, minggu
        $('#bulan-mingguan').on('change', function(){
            params['bulan_m'] = $(this).val();
            getRekap("#rekap-container", params);
        });

        $('#tahun-mingguan').on('change', function(){
            params['tahun_m'] = $(this).val();
            getRekap("#rekap-container", params);
        });

        $('#minggu').on('change', function(){
            params['minggu'] = $(this).val();
            getRekap("#rekap-container", params);
        });

        // rekap bulanan -> jenis, bulan, tahun
        $('#bulan-bulanan').on('change', function(){
            params['bulan_b'] = $(this).val();
            getRekap("#rekap-container", params);
        });

        $('#tahun-bulanan').on('change', function(){
            params['tahun_b'] = $(this).val();
            getRekap("#rekap-container", params);
        });
    });
</script>