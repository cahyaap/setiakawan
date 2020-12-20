<script type="text/javascript">
    $(document).ready(function($){

        var columns = [
            {
                title: "Nomor Induk",
                className: "text-center"
            },
            {
                title: "Nama"
            },
            {
                title: "Absensi",
                className: 'text-center',
                render: function(data, type, row) {
                    var absensi = "<span class='badge bg-success'>Hadir</span>";
                    if(row[2] == 'c'){
                        absensi = "<span class='badge bg-warning'>Cuti</span>";
                    }
                    if(row[2] == 'i'){
                        absensi = "<span class='badge bg-primary'>Izin</span>";
                    }
                    if(row[2] == 'a'){
                        absensi = "<span class='badge bg-danger'>Absen</span>";
                    }
                    if(row[2] == 's'){
                        absensi = "<span class='badge bg-warning'>Sakit</span>";
                    }
                    if(row[2] == 'l'){
                        absensi = "<span class='badge bg-info'>Libur</span>";
                    }

                    return absensi;
                }
            },
            {
                title: "Keterangan",
                render: function(data, type, row) {
                    return (row[3]) ? row[3] : "-";
                }
            },
            {
                title: "Aksi",
                className: 'text-center',
                render: function(data, type, row) {
                    var list = "<a class='btn btn-sm btn-success aksi-btn detail-btn' alt='Daftar' title='Daftar' href='#daftarAbsensi' data-aksi='daftar' data-id='"+row[4]+"' data-toggle='modal' data-target='#daftarAbsensi'><span><i class='fa fa-list'></i></span></a>";
                    var detail = "<a class='btn btn-sm btn-info aksi-btn detail-btn' alt='Detail' title='Detail' href='#detailAbsensi' data-aksi='detail' data-id='"+row[4]+"' data-toggle='modal' data-target='#detailAbsensi'><span><i class='fa fa-file'></i></span></a>";
                    var edit = "<a class='btn btn-sm btn-warning aksi-btn edit-btn' alt='Edit' title='Edit' href='#editAbsensi' data-aksi='edit' data-nomor-induk='"+row[0]+"' data-name='"+row[1]+"' data-absensi='"+row[2]+"' data-ket='"+row[3]+"' data-id='"+row[4]+"' data-toggle='modal' data-target='#editAbsensi'><span><i class='fa fa-pencil'></i></span></a>";
                    return list + " " + detail + " " + edit;
                }
            }
        ];

        getTableData("{{ route('get-absensi') }}", "#tabel-absensi", columns, { tanggal: $('#tanggal').val() }, [[0, "desc"]]);

        var weekday = new Array(7);
        weekday[0] = "Minggu";
        weekday[1] = "Senin";
        weekday[2] = "Selasa";
        weekday[3] = "Rabu";
        weekday[4] = "Kamis";
        weekday[5] = "Jum'at";
        weekday[6] = "Sabtu";

        var month = new Array(12);
        month[0] = "Januari";
        month[1] = "Feburari";
        month[2] = "Maret";
        month[3] = "April";
        month[4] = "Mei";
        month[5] = "Juni";
        month[6] = "Juli";
        month[7] = "Agustus";
        month[8] = "September";
        month[9] = "Oktober";
        month[10] = "November";
        month[11] = "Desember";

        var timestamp = new Date($('#tanggal').val()).getTime()/1000;
        $('#waktu-absensi').html(" - " + timestampToDate(timestamp));

        function timestampToDate(timestamp){
            var date = new Date(timestamp * 1000);
            var tanggal = weekday[date.getDay()]+ ", " + date.getDate() + " " + month[date.getMonth()] + " " + date.getFullYear();
            return tanggal;
        }

        $('#filter-absensi').submit(function(e){
            e.preventDefault();
            timestamp = new Date($('#tanggal').val()).getTime()/1000;
            $('#waktu-absensi').empty();
            $('#waktu-absensi').html(" - " + timestampToDate(timestamp));
            $('#tabel-absensi').DataTable().destroy();
            $('#tabel-absensi').empty();
            getTableData("{{ route('get-absensi') }}", "#tabel-absensi", columns, { tanggal: $('#tanggal').val() }, [[0, "desc"]]);
        });

        $(document).on('click', '.aksi-btn', function(){
            var _this = $(this);
            var absensi_id = _this.data('id');
            var aksi = _this.data('aksi');
            var route = "";
            if(aksi === "daftar"){
                route = "{{ route('daftar-absensi', 'absensi_id') }}";
                route = route.replace('absensi_id', absensi_id);
                getAksiData(route, '#daftar-absensi-data', { tanggal: $('#tanggal').val() });
            }
            if(aksi === "detail"){
                route = "{{ route('absensi.show', 'absensi_id') }}";
                route = route.replace('absensi_id', absensi_id);
                getAksiData(route, '#detail-absensi-data', { tanggal: $('#tanggal').val() });
            }
            if(aksi === "edit"){
                $('#edit-tanggal').val($('#tanggal').val());
                $('#edit-name').val(_this.data('name'));
                $('#edit-ket').val(_this.data('ket'));
                $('#edit-jenis').val(_this.data('absensi'));
                route = "{{ route('absensi.update', 'absensi_id') }}";
                route = route.replace('absensi_id', absensi_id);
                $('#edit-absensi-form').attr('action', route);
            }
            if(aksi === "hapus"){
                var name = _this.data('name');
                route = "{{ route('absensi.destroy', 'absensi_id') }}";
                route = route.replace('absensi_id', karyawan_id);
                $('.absensi-name').empty();
                $('.absensi-name').html(name);
                $('#hapus-absensi-form').attr('action', route);
            }
        });
    });
</script>