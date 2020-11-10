@extends('layouts.default')

@push('after-style')
@include('pages.transaksi.style')
@endpush

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="box-title" style="margin-top: 10px;margin-bottom: -10px">Transaksi</h3>
                </div>
            </div>
            <hr>

            <div class="tab-list">
                <div class="tab tab-active" id="pembelian">Pembelian</div>
                <div class="tab" id="penjualan">Penjualan</div>
            </div>

            <div class="row" id="tab-pembelian">
                <div class="col-md-12">
                    <button id="tambah-pembelian" data-transaksi="pembelian" class="btn btn-primary transaksi-button">Buat Bon Pembelian</button>
                </div>
                <div id="tambah-pembelian-box" class="col-md-12 transaksi-box">
                    @include('pages.transaksi.pembelian', ['barangs' => $barangs])
                </div>
                <div id="tabel-pembelian-box" class="col-md-12 table-responsive">
                    <table id="tabel-pembelian" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Seller</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1
                            @endphp
                            @foreach ($transaksis as $item)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td class="text-center">{{ date("m F Y", strtotime($item->created_at)) }}</td>
                                <td>{{ $item->seller->name }}</td>
                                <td class="text-right">{{ number_format($item->detail[0]->total, 0) }}</td>
                                <td>{{ $item->ket }}</td>
                                <td class="text-center">
                                    <a href="#detailTransaksi" data-id="{{ $item->id }}" data-toggle="modal" data-target="#detailTransaksi">Detail</a>
                                    <a href="#editTransaksi">Edit</a>
                                    <a href="#hapusTransaksi" data-id="{{ $item->id }}" data-toggle="modal" data-target="#hapusTransaksi">Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row" id="tab-penjualan" style="display: none;">
                <div class="col-md-12">
                    <button id="tambah-penjualan" data-transaksi="penjualan" class="btn btn-primary transaksi-button">Buat Bon Penjualan</button>
                </div>
                <div id="tambah-penjualan-box" class="col-md-12 transaksi-box">
                    @include('pages.transaksi.penjualan')
                </div>
                <div id="tabel-penjualan-box" class="col-md-12 table-responsive">
                    <table id="tabel-penjualan" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@include('pages.transaksi.modal')
@endsection

@push('after-script')
@include('pages.transaksi.script')
@endpush