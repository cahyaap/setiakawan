@extends('layouts.default')

<style type="text/css">
    tr.group td {
        background: lightblue;
        color: black;
    }
</style>

@section('content')
<div class="animated fadeIn row">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="box-title" style="margin-top: 10px;margin-bottom: -10px">Daftar Barang</h3>
                </div>
                <div class="col-md-4">
                    <a style="color:white;" class="pull-right" href="#tambah-barang">
                        <span class="circle circle-sm bg-success di" data-toggle="modal" data-target="#tambahBarang" title="Tambah Barang" data-placement="bottom"><i class="ti-plus"></i></span>
                    </a>
                </div>
            </div>
            <hr>
            <div id="data-tabel">
                <div class="table-responsive">
                    <table id="tabel-barang" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Kode</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Tonase (Stok)</th>
                                {{-- <th class="text-center">Keterangan</th> --}}
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($collection as $item)
                            <tr>
                                <td>{{ $item->kategori->name }}</td>
                                <td>{{ $item->kode }}</td>
                                <td>{{ $item->name }}</td>
                                <td class="text-center">{{ number_format($item->stok, 2) }}</td>
                                {{-- <td>{{ $item->ket }}</td> --}}
                                <td class="text-center">
                                    <a href="#" class="editBarangButton" data-toggle="modal" data-target="#editBarang" data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-kategori-id="{{ $item->kategori_id }}" data-kode="{{ $item->kode }}" data-ket="{{ $item->ket }}" data-used="<?= (in_array($item->id, $barangUsed)) ? true : false ?>">Edit</a>
                                    @if (!in_array($item->id, $barangUsed))
                                    <a href="#" class="hapusBarangButton" data-toggle="modal" data-target="#hapusBarang" data-id="{{ $item->id }}" data-name="{{ $item->name }}">Hapus</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@include('pages.barang.modal')

@push('after-script')
<script type="text/javascript">
    $(document).ready(function($){

        $('.select2').select2();

        // var groupColumn = 0;
        // var table = $('#tabel-barang').DataTable({
        //     "columnDefs": [
        //         { "visible": false, "targets": groupColumn },
        //         { "orderable": false, "targets": 1 },
        //         { "orderable": false, "targets": 2 },
        //         { "orderable": false, "targets": 3 },
        //         { "orderable": false, "targets": 4 },
        //         { "orderable": false, "targets": 5 }
        //     ],
        //     "order": [[ groupColumn, 'asc' ], [ 2, 'asc' ]],
        //     "displayLength": 25,
        //     "drawCallback": function ( settings ) {
        //         var api = this.api();
        //         var rows = api.rows( {page:'current'} ).nodes();
        //         var last=null;
    
        //         api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
        //             if ( last !== group ) {
        //                 $(rows).eq( i ).before(
        //                     '<tr class="group"><td colspan="5">'+group+'</td></tr>'
        //                 );
    
        //                 last = group;
        //             }
        //         } );
        //     }
        // } );
    
        // // Order by the grouping
        // $('#tabel-barang tbody').on( 'click', 'tr.group', function () {
        //     var currentOrder = table.order()[0];
        //     if ( currentOrder[0] === groupColumn && currentOrder[1] === 'asc' ) {
        //         table.order( [ groupColumn, 'desc' ] ).draw();
        //     }
        //     else {
        //         table.order( [ groupColumn, 'asc' ] ).draw();
        //     }
        // } );

        var tabel = $('#tabel-barang').DataTable({
            "order": [[ 0, "asc" ],[ 2, "asc" ]]
        });

        function inputEnabled(input){
            $(input).removeAttr('readonly');
            $(input).removeAttr('disabled');
        }

        function inputDisabled(input){
            $(input).attr('readonly', true);
            $(input).attr('disabled', true);
        }

        $(document).on('click', '.editBarangButton', function(){
            var _this = $(this);
            var updateRoute = "{{ route('barang.update', 'barang_id') }}";
            var route = updateRoute.replace('barang_id', _this.attr('data-id'));
            $('#update-alert').hide();
            $('#edit-kategori-id').val(_this.attr('data-kategori-id'));
            $("#edit-kategori-id").select2("val", _this.attr('data-kategori-id'));
            $('#edit-name').val(_this.attr('data-name'));
            $('#edit-kode').val(_this.attr('data-kode'));
            $('#edit-ket').val(_this.attr('data-ket'));
            $('#edit-barang-form').attr('action', route);
            if(_this.attr('data-used')){
                $('#update-alert').show();
            }
        });
        $(document).on('click', '.hapusBarangButton', function(){
            var _this = $(this);
            var deleteRoute = "{{ route('barang.destroy', 'barang_id') }}";
            var route = deleteRoute.replace('barang_id', _this.attr('data-id'));
            $('#hapus-barang-form').attr('action', route);
            $('.barang-name').html(_this.attr('data-name'));
        });
    });
</script>
@endpush