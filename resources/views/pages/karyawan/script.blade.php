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
                title: "Alamat"
            },
            {
                title: "Status",
                className: 'text-center',
                render: function(data, type, row) {
                    var status = "<span class='badge bg-success'>Aktif</span>";
                    if(row[3] != 1){
                        status = "<span class='badge bg-danger'>Tidak Aktif</span>"
                    }
                    return status;
                }
            },
            {
                title: "Aksi",
                className: 'text-center',
                render: function(data, type, row) {
                    var edit = "<a class='btn btn-sm btn-warning aksi-btn edit-btn' alt='Edit' title='Edit' href='#editKaryawan' data-aksi='edit' data-nomor-induk='"+row[0]+"' data-name='"+row[1]+"' data-alamat='"+row[2]+"' data-status='"+row[3]+"' data-id='"+row[4]+"' data-toggle='modal' data-target='#editKaryawan'><span><i class='fa fa-pencil'></i></span></a>";
                    var hapus = "";
                    if(!row[5]){
                        hapus = "<a class='btn btn-sm btn-danger aksi-btn hapus-btn' alt='Hapus' title='Hapus' href='#hapusKaryawan' data-nomor-induk='"+row[0]+"' data-aksi='hapus' data-name='"+row[1]+"' data-id='"+row[4]+"' data-toggle='modal' data-target='#hapusKaryawan'><span><i class='fa fa-trash'></i></span></a>";
                    }
                    return edit + " " + hapus
                }
            }
        ];

        getTableData("{{ route('get-karyawan') }}", "#tabel-karyawan", columns, null, [[0, "desc"]]);

        $(document).on('click', '.aksi-btn', function(){
            var _this = $(this);
            var karyawan_id = _this.data('id');
            var aksi = _this.data('aksi');
            var route = "";
            if(aksi === "edit"){
                $('#edit-nomor-karyawan').val(_this.data('nomor-induk'));
                $('#edit-name').val(_this.data('name'));
                $('#edit-alamat').val(_this.data('alamat'));
                $('#edit-status').val(_this.data('status'));
                route = "{{ route('karyawan.update', 'karyawan_id') }}";
                route = route.replace('karyawan_id', karyawan_id);
                $('#edit-karyawan-form').attr('action', route);
            }
            if(aksi === "hapus"){
                var name = _this.data('name');
                route = "{{ route('karyawan.destroy', 'karyawan_id') }}";
                route = route.replace('karyawan_id', karyawan_id);
                $('.karyawan-name').empty();
                $('.karyawan-name').html(_this.data('nomor-induk') + " - " + name);
                $('#hapus-karyawan-form').attr('action', route);
            }
        });
    });
</script>