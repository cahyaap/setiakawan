@extends('layouts.default')

@push('after-style')
@include('pages.retur.style')
@endpush

@section('content')
<div class="animated fadeIn row">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="box-title" style="margin-top: 10px;margin-bottom: -10px">Retur</h3>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12 transaksi-button-list">
                    <button id="1" data-transaksi="pembelian" class="btn btn-primary transaksi-button">Retur Pembelian</button>
                    <button id="2" data-transaksi="penjualan" class="btn btn-warning transaksi-button">Retur Penjualan</button>
                </div>
                <div id="tambah-transaksi-box" class="col-md-12 transaksi-box">
                    <div class="load-content text-center">Memuat data... <span><i class="fa fa-spinner fa-spin"></i></span></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 table-responsive">
                    <div class="load-content text-center">Memuat data... <span><i class="fa fa-spinner fa-spin"></i></span></div>
                    <table id="tabel-retur" class="display" cellspacing="0" width="100%"></table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@include('pages.retur.modal')

@push('after-script')
@include('pages.retur.script')
@endpush