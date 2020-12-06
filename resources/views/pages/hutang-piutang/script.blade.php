<script type="text/javascript">
    $(document).ready(function($){

        $('.select2').select2();

        var columns = [
            {
                title: "Tanggal",
                className: "text-center"
            },
            {
                title: "Nama"
            },
            {
                title: "Tipe",
                className: 'text-center'
            },
            {
                title: "Jumlah",
                className: 'text-right',
                render: function(data, type, row) {
                    return addCommas(row[3]);
                }
            },
            {
                title: "Status",
                className: 'text-center',
                render: function(data, type, row) {
                    var jenis = "";
                    if(row[4] == "Kredit"){
                        jenis = "<span class='badge badge-danger'>"+row[4]+"</span>";
                    } else {
                        jenis = "<span class='badge badge-success'>"+row[4]+"</span>";
                    }
                    return jenis
                }
            },
            {
                title: "Aksi",
                className: 'text-center',
                render: function(data, type, row) {
                    var edit = "<a class='btn btn-sm btn-warning aksi-btn edit-btn' alt='Edit' title='Edit' href='#editHutangPiutang' data-name='"+row[1]+"'  data-tipe='"+row[2]+"' data-jumlah='"+row[3]+"' data-aksi='edit' data-id='"+row[5][0]+"' data-seller-id='"+row[5][1]+"' data-toggle='modal' data-target='#editHP'><span><i class='fa fa-pencil'></i></span></a>";
                    var hapus = "<a class='btn btn-sm btn-danger aksi-btn hapus-btn' alt='Hapus' title='Hapus' href='#hapusHutangPiutang' data-name='"+row[1]+"' data-aksi='hapus' data-tipe='"+row[2]+"' data-jumlah='"+row[3]+"' data-id='"+row[5][0]+"' data-toggle='modal' data-target='#hapusHP'><span><i class='fa fa-trash'></i></span></a>";
                    return edit + " " + hapus
                }
            }
        ];

        getTableData("{{ route('get-hutang') }}", "#tabel-hutang-piutang", columns, null, [[0, "desc"]]);

        $(document).on('click', '.aksi-btn', function(){
            var _this = $(this);
            var hutang_id = _this.data('id');
            var aksi = _this.data('aksi');
            var route = "";
            if(aksi === "edit"){
                $('#edit-seller-id').select2('val', _this.data('seller-id'));
                $('#edit-tipe').val(_this.data('tipe'));
                $('#edit-jumlah').val(_this.data('jumlah'));
                route = "{{ route('hutang-piutang.update', 'hutang_id') }}";
                route = route.replace('hutang_id', hutang_id);
                $('#edit-hutang-piutang-form').attr('action', route);
            }
            if(aksi === "hapus"){
                var name = _this.data('name');
                var tipe = _this.data('tipe');
                var jumlah = _this.data('jumlah');
                route = "{{ route('hutang-piutang.destroy', 'hutang_id') }}";
                route = route.replace('hutang_id', hutang_id);
                $('.tipe-hp').empty();
                $('.seller-name').empty();
                $('.seller-jumlah').empty();
                $('.tipe-hp').empty(tipe);
                $('.seller-name').html(name);
                $('.seller-jumlah').html(jumlah);
                $('#hapus-hutang-piutang-form').attr('action', route);
            }
        });
    });
</script>