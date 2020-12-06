<script type="text/javascript">
    $(document).ready(function($){

        var columns = [
            {
                title: "Nama"
            },
            {
                title: "Tipe",
                className: 'text-center',
                render: function(data, type, row) {
                    return (row[1] == "1") ? "Seller" : "Buyer"
                }
            },
            {
                title: "Alamat"
            },
            {
                title: "Aksi",
                className: 'text-center',
                render: function(data, type, row) {
                    var edit = "<a class='btn btn-sm btn-warning aksi-btn edit-btn' alt='Edit' title='Edit' href='#editSeller' data-name='"+row[0]+"'  data-jenis='"+row[1]+"' data-alamat='"+row[2]+"' data-aksi='edit' data-id='"+row[3]+"' data-toggle='modal' data-target='#editSeller'><span><i class='fa fa-pencil'></i></span></a>";
                    var hapus = "";
                    if(!row[4]){
                        hapus = "<a class='btn btn-sm btn-danger aksi-btn hapus-btn' alt='Hapus' title='Hapus' href='#hapusSeller' data-name='"+row[0]+"' data-aksi='hapus' data-id='"+row[3]+"' data-toggle='modal' data-target='#hapusSeller'><span><i class='fa fa-trash'></i></span></a>";
                    }
                    return edit + " " + hapus
                }
            }
        ];

        getTableData("{{ route('get-seller') }}", "#tabel-seller", columns);

        $(document).on('click', '.aksi-btn', function(){
            var _this = $(this);
            var seller_id = _this.data('id');
            var aksi = _this.data('aksi');
            var route = "";
            if(aksi === "edit"){
                $('#edit-name').val(_this.data('name'));
                $('#edit-jenis').val(_this.data('jenis'));
                $('#edit-alamat').val(_this.data('alamat'));
                route = "{{ route('seller.update', 'seller_id') }}";
                route = route.replace('seller_id', seller_id);
                $('#edit-seller-form').attr('action', route);
            }
            if(aksi === "hapus"){
                var name = _this.data('name');
                route = "{{ route('seller.destroy', 'seller_id') }}";
                route = route.replace('seller_id', seller_id);
                $('.seller-name').empty();
                $('.seller-name').html(name);
                $('#hapus-seller-form').attr('action', route);
            }
        });
    });
</script>