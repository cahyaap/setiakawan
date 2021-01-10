<script type="text/javascript">
    $(document).ready(function($){

        var tabel = $('#tabel-tambah-stok-opname, #tabel-detail-stok-opname').DataTable({
            "order": [[ 0, "asc" ],[ 1, "asc" ]],
            "paging": false
        });

        var columns = [
            {
                title: "Tanggal",
                className: 'text-center',
            },
            {
                title: "Stok Web (kg)",
                className: 'text-center',
            },
            {
                title: "Stok Real (kg)",
                className: 'text-center',
            },
            {
                title: "Selisih (kg)",
                className: 'text-center',
            },
            {
                title: "Keterangan"
            },
            {
                title: "Aksi",
                className: 'text-center',
                render: function(data, type, row) {
                    var detailRoute = "{{ route('stok-opname.show', 'stok_opname_id') }}";
                    detailRoute = detailRoute.replace('stok_opname_id', row[5]);
                    var editRoute = "{{ route('stok-opname.edit', 'stok_opname_id') }}";
                    editRoute = editRoute.replace('stok_opname_id', row[5]);
                    var setStokBtn = (row[6] == "1") ? "btn-default" : "btn-success";
                    var setStok = "<a class='btn btn-sm "+setStokBtn+" aksi-btn detail-btn' alt='Set Stock' data-aksi='set-stok' title='Set Stock' href='#setStok' data-id='"+row[5]+"' data-tanggal='"+row[0]+"' data-target='#setStok' data-toggle='modal'><span><i class='fa fa-refresh'></i></span></a>";
                    var detail = "<a class='btn btn-sm btn-info aksi-btn detail-btn' alt='Detail' title='Detail' href='"+detailRoute+"'><span><i class='fa fa-search-plus'></i></span></a>";
                    var edit = "<a class='btn btn-sm btn-warning aksi-btn edit-btn' alt='Edit' title='Edit' href='"+editRoute+"'><span><i class='fa fa-pencil'></i></span></a>";
                    var hapus = "<a class='btn btn-sm btn-danger aksi-btn hapus-btn' alt='Hapus' title='Hapus' href='#hapusStokOpname' data-aksi='hapus' data-tanggal='"+row[0]+"' data-id='"+row[5]+"' data-toggle='modal' data-target='#hapusStokOpname'><span><i class='fa fa-trash'></i></span></a>";
                    return setStok + " " + detail + " " + edit + " " + hapus
                }
            }
        ];

        getTableData("{{ route('get-stok-opname') }}", "#tabel-stok-opname", columns, null, [[0, "desc"]]);

        $(document).on('change', '.stok-real', function(){
            var totalReal = 0;
            var totalSelisih = 0;
            var barang_id = $(this).data('barang-id');
            var stokReal = $(this).val();
            var stokWeb = $('#stok-web-'+barang_id).val();
            var selisih = stokReal - stokWeb;
            $('#selisih-'+barang_id).html(0);
            $('#selisih-'+barang_id).html(selisih.toFixed(2));
            $('.stok-real').each(function(){
                stokReal = 0;
                if($(this).val() > 0){
                    stokReal = parseFloat($(this).val());
                }
                barang_id = $(this).data('barang-id');
                stokWeb = $('#stok-web-'+barang_id).val();
                selisih = stokReal - stokWeb;
                totalSelisih += selisih;
                totalReal += stokReal;
            });
            $('#total-real').html(addCommas(totalReal.toFixed(2)));
            $('#total-selisih').html(addCommas(totalSelisih.toFixed(2)));
        });

        $(document).on('click', '.aksi-btn', function(){
            var _this = $(this);
            var stok_opname_id = _this.data('id');
            var aksi = _this.data('aksi');
            var route = "";
            if(aksi === "set-stok"){
                var tanggal = _this.data('tanggal');
                $('.tanggal-stok-opname').html(tanggal);
                $('#stok_opname_id').val(stok_opname_id);
            }
            if(aksi === "detail"){
                route = "{{ route('stok-opname.show', 'stok_opname_id') }}";
                route = route.replace('stok_opname_id', stok_opname_id);
                getAksiData(route, '#detail-stok-opname-data');
            }
            if(aksi === "hapus"){
                var tanggal = _this.data('tanggal');
                route = "{{ route('stok-opname.destroy', 'stok_opname_id') }}";
                route = route.replace('stok_opname_id', stok_opname_id);
                $('.tanggal-stok-opname').empty();
                $('.tanggal-stok-opname').html(tanggal);
                $('#hapus-stok-opname-form').attr('action', route);
            }
        });
    });
</script>