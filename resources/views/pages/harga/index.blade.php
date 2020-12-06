@extends('layouts.default')

@section('content')
<div class="animated fadeIn row">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="box-title">Daftar Harga</h3>
                </div>
                <div class="col-md-4">
                    <a style="color:white;" class="pull-right" href="#tambah-harga">
                        <span class="circle circle-sm bg-success di" data-toggle="modal" data-target="#tambahHarga" title="Tambah Harga" data-placement="bottom"><i class="ti-plus"></i></span>
                    </a>
                </div>
            </div>
            <hr>
            <div id="data-tabel">
                <div class="table-responsive">
                    <table id="tabel-harga" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Kode</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Beli</th>
                                <th class="text-center">Jual</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1    
                            @endphp
                            @foreach ($collection as $item)
                            <tr>
                                <td>{{ $item->barang->kategori->name }}</td>
                                <td>{{ $item->barang->kode }}</td>
                                <td>{{ $item->barang->name }}</td>
                                <td class="text-right">{{ number_format($item->beli, 0) }}</td>
                                <td class="text-right">{{ number_format($item->jual, 0) }}</td>
                                <td>{{ $item->ket }}</td>
                                <td class="text-center">
                                    <a href="#" class="editHargaButton" data-toggle="modal" data-target="#editHarga" data-id="{{ $item->id }}" data-beli="{{ $item->beli }}" data-barang-id="{{ $item->barang_id }}" data-jual="{{ $item->jual }}" data-ket="{{ $item->ket }}">Edit</a>
                                    <a href="#" class="hapusHargaButton" data-toggle="modal" data-target="#hapusHarga" data-id="{{ $item->id }}" data-name="{{ $item->barang->name }}">Hapus</a>
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

@include('pages.harga.modal')

@push('after-script')
<script type="text/javascript">
    $(document).ready(function($){

        $('.select2').select2();

        var tabel = $('#tabel-harga').DataTable({
            "order": [[0, 'asc'], [2, 'asc']]
        });
        $(document).on('click', '.editHargaButton', function(){
            var _this = $(this);
            var updateRoute = "{{ route('harga.update', 'harga_id') }}";
            var route = updateRoute.replace('harga_id', _this.attr('data-id'));
            $('#edit-barang-id').val(_this.attr('data-barang-id'));
            $("#edit-barang-id").select2("val", _this.attr('data-barang-id'));
            $('#edit-beli').val(_this.attr('data-beli'));
            $('#edit-jual').val(_this.attr('data-jual'));
            $('#edit-ket').val(_this.attr('data-ket'));
            $('#edit-harga-form').attr('action', route);
        });
        $(document).on('click', '.hapusHargaButton', function(){
            var _this = $(this);
            var deleteRoute = "{{ route('harga.destroy', 'harga_id') }}";
            var route = deleteRoute.replace('harga_id', _this.attr('data-id'));
            $('#hapus-harga-form').attr('action', route);
            $('.barang-name').html(_this.attr('data-name'));
        });
    });
</script>
@endpush