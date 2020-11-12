@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="box-title" style="margin-top: 10px;margin-bottom: -10px">Kategori Barang</h3>
                </div>
                <div class="col-md-4">
                    <a style="color:white;" class="pull-right" href="#tambah-kategori">
                        <span class="circle circle-sm bg-success di" data-toggle="modal" data-target="#tambahKategori" title="Tambah Kategori" data-placement="bottom"><i class="ti-plus"></i></span>
                    </a>
                </div>
            </div>
            <hr>
            <div id="data-tabel">
                <div class="table-responsive">
                    <table id="tabel-kategori" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Nama Kategori</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1    
                            @endphp
                            @foreach ($collection as $item)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td>{{ $item->name }}</td>
                                <td class="text-center">
                                    @if (!in_array($item->id, $kategoriUsed))
                                    <a href="#" class="editKategoriButton" data-toggle="modal" data-target="#editKategori" data-id="{{ $item->id }}" data-name="{{ $item->name }}">Edit</a>
                                    <a href="#" class="hapusKategoriButton" data-toggle="modal" data-target="#hapusKategori" data-id="{{ $item->id }}" data-name="{{ $item->name }}">Hapus</a>
                                    @else
                                    <small style="font-style: italic;">Data sedang digunakan</small>
                                    @endif
                                </tr>
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

@include('pages.kategori.modal')

@push('after-script')
<script type="text/javascript">
    $(document).ready(function($){
        var tabel = $('#tabel-kategori').DataTable();
        $(document).on('click', '.editKategoriButton', function(){
            var _this = $(this);
            var updateRoute = "{{ route('kategori.update', 'kategori_id') }}";
            var route = updateRoute.replace('kategori_id', _this.attr('data-id'));
            $('#edit-name').val(_this.attr('data-name'));
            $('#edit-kategori-form').attr('action', route);
        });
        $(document).on('click', '.hapusKategoriButton', function(){
            var _this = $(this);
            var deleteRoute = "{{ route('kategori.destroy', 'kategori_id') }}";
            var route = deleteRoute.replace('kategori_id', _this.attr('data-id'));
            $('#hapus-kategori-form').attr('action', route);
            $('.kategori-name').html(_this.attr('data-name'));
        });
    });
</script>
@endpush