<script type="text/javascript">
    $(document).ready(function($){

        $('.select2').select2();

        var columns = [
            {
                title: "#",
                className: "text-center"
            },
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
                title: "Jenis",
                className: 'text-center'
            },
            {
                title: "Jumlah",
                className: 'text-right',
                render: function(data, type, row) {
                    return addCommas(row[5]);
                }
            },
            {
                title: "Keterangan",
                render: function(data, type, row) {
                    return (row[6]) ? row[6] : "-";
                }
            },
            {
                title: "Aksi",
                className: 'text-center',
                render: function(data, type, row) {
                    var edit = "<a class='btn btn-sm btn-warning aksi-btn edit-btn' alt='Edit' title='Edit' href='#editHutangPiutang' data-name='"+row[2]+"'  data-tipe='"+row[3]+"' data-jenis='"+row[4]+"' data-jumlah='"+row[5]+"' data-ket='"+row[6]+"' data-aksi='edit' data-id='"+row[7][0]+"' data-seller-id='"+row[7][1]+"' data-toggle='modal' data-target='#editHP'><span><i class='fa fa-pencil'></i></span></a>";
                    var hapus = "<a class='btn btn-sm btn-danger aksi-btn hapus-btn' alt='Hapus' title='Hapus' href='#hapusHutangPiutang' data-name='"+row[2]+"' data-aksi='hapus' data-tipe='"+row[3]+"' data-jumlah='"+row[5]+"' data-id='"+row[7][0]+"' data-toggle='modal' data-target='#hapusHP'><span><i class='fa fa-trash'></i></span></a>";
                    return (row[7][2]) ? "-" : edit + " " + hapus
                }
            }
        ];

        getTableData("{{ route('get-hutang') }}", "#tabel-hutang-piutang", columns, null, [[0, "asc"]]);

        $(document).on('keyup', '#jumlah, #edit-jumlah', function(){
            $(this).val(function(index, value) {
                return value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            });
        });

        $(document).on('click', '.aksi-btn', function(){
            var _this = $(this);
            var hutang_id = _this.data('id');
            var aksi = _this.data('aksi');
            var route = "";
            if(aksi === "edit"){
                $('#edit-seller-id').select2('val', _this.data('seller-id'));
                $("#edit-tipe-"+_this.data('tipe')).prop("checked", true);
                $("#edit-jenis-"+_this.data('jenis')).prop("checked", true);
                $('#edit-jumlah').val(addCommas(_this.data('jumlah')));
                $('#edit-ket').val(_this.data('ket'));
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
                $('.seller-name').empty();
                $('.seller-jumlah').empty();
                $('.seller-name').html(name);
                $('.seller-jumlah').html(jumlah);
                $('#hapus-hutang-piutang-form').attr('action', route);
            }
        });
    });
</script>