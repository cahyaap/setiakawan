@extends('layouts.default')

@push('after-style')
@include('pages.transaksi.style')
@endpush

@section('content')
<div class="animated fadeIn row">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="box-title" style="margin-top: 10px;margin-bottom: -10px">Transaksi</h3>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-md-12 transaksi-button-list">
                    <button id="1" data-transaksi="pembelian" class="btn btn-primary transaksi-button">Bon Pembelian</button>
                    <button id="2" data-transaksi="penjualan" class="btn btn-warning transaksi-button">Bon Penjualan</button>
                    <button id="3" data-transaksi="pengeluaran" class="btn btn-default" data-toggle="modal" data-target="#modalPengeluaran">Pengeluaran lainnya</button>
                    <a href="{{ route('retur.index') }}" class="btn btn-primary pull-right">Retur</a>
                </div>
                <div id="tambah-transaksi-box" class="col-md-12 transaksi-box">
                    <div class="load-content text-center">Memuat data... <span><i class="fa fa-spinner fa-spin"></i></span></div>
                    {{-- @include('pages.transaksi.bon', ['barangs' => $barangs]) --}}
                </div>
                {{-- <div id="tambah-pengeluaran-box" class="col-md-12 transaksi-box">
                    @include('pages.transaksi.pengeluaran', ['barangs' => $barangs])
                </div> --}}
            </div>

            <div class="tab-list">
                <div class="tab tab-active" id="pembelian">Pembelian</div>
                <div class="tab" id="penjualan">Penjualan</div>
                <div class="tab" id="pengeluaran">Pengeluaran lainnya</div>
            </div>

            <div class="row transaksi" id="tab-pembelian">
                <div id="tabel-pembelian-box" class="col-md-12 table-responsive">
                    <div class="load-content text-center">Memuat data... <span><i class="fa fa-spinner fa-spin"></i></span></div>
                    <table id="tabel-pembelian" class="display" cellspacing="0" width="100%"></table>
                </div>
            </div>

            <div class="row transaksi" id="tab-penjualan" style="display: none;">
                <div id="tabel-penjualan-box" class="col-md-12 table-responsive">
                    <div class="load-content text-center">Memuat data... <span><i class="fa fa-spinner fa-spin"></i></span></div>
                    <table id="tabel-penjualan" class="display" cellspacing="0" width="100%"></table>
                </div>
            </div>

            <div class="row transaksi" id="tab-pengeluaran" style="display: none;">
                <div id="tabel-pengeluaran-box" class="col-md-12 table-responsive">
                    <div class="load-content text-center"><span><i class="fa fa-spinner fa-spin"></i></span></div>
                    <div class="load-content text-center">Memuat data... <span><i class="fa fa-spinner fa-spin"></i></span></div>
                    <table id="tabel-pengeluaran" class="display" cellspacing="0" width="100%"></table>
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