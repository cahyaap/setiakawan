@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="box-title" style="margin-top: 10px;margin-bottom: -10px">Tambah Stok Opname</h3>
                </div>
                <div class="col-md-4">
                    <a style="color:white;" class="pull-right" href="{{ route('stok-opname.index') }}">
                        <span class="circle circle-sm bg-warning di" title="Kembali" data-placement="bottom"><i class="ti-arrow-left"></i></span>
                    </a>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('stok-opname.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <table id="tabel-tambah-stok-opname" class="display" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Kategori</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Stok Web (kg)</th>
                                        <th class="text-center">Stok Real (kg)</th>
                                        <th class="text-center">Selisih (kg)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($barangs as $item)
                                    <tr>
                                        <td>{{ $item->kategori->name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td class="text-center">{{ number_format($item->stok, 2) }}</td>
                                        <td class="text-center">
                                            <input type="hidden" name="barang_id[]" id="barang-id-{{ $item->id }}" value="{{ $item->id }}">
                                            <input type="hidden" name="stok_web[]" id="stok-web-{{ $item->id }}" value="{{ $item->stok }}">
                                            <input type="number" step="0.01" name="stok_real[]" id="stok-real-{{ $item->id }}" data-barang-id="{{ $item->id }}" class="text-center stok-real" required>
                                        </td>
                                        <td class="text-center" id="selisih-{{ $item->id }}">{{ number_format(0-$item->stok, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <th class="text-center" colspan="2">Total</th>
                                    <th class="text-center">{{ number_format($barangs->sum('stok'), 2) }}</th>
                                    <th class="text-center" id="total-real">0</th>
                                    <th class="text-center" id="total-selisih">{{ number_format(0-$barangs->sum('stok'), 2) }}</th>
                                </tfoot>
                            </table>
                        </div>
                        <div class="form-group">
                            <label for="ket">Keterangan</label>
                            <textarea name="ket" id="ket" rows="4" class="form-control" placeholder="Masukkan keterangan disini..."></textarea>
                        </div>
                        <div class="form-group text-center">
                            <a href="{{ route('stok-opname.index') }}" class="btn btn-default waves-effect" >Kembali</a>
                            <button type="submit" class="btn btn-success waves-effect waves-light">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-script')
@include('pages.stok-opname.script')
@endpush