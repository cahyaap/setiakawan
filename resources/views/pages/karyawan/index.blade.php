@extends('layouts.default')

<style>
    .nomor-karyawan-alert {
        font-style: italic;
        color: red !important;
    }
</style>

@section('content')
<div class="animated fadeIn row">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="box-title" style="margin-top: 10px;margin-bottom: -10px">Karyawan</h3>
                </div>
                <div class="col-md-4">
                    <a style="color:white;" class="pull-right" href="#tambahKaryawan">
                        <span class="circle circle-sm bg-success di" data-toggle="modal" data-target="#tambahKaryawan" title="Tambah Karyawan" data-placement="bottom"><i class="ti-plus"></i></span>
                    </a>
                </div>
            </div>
            <hr>
            <div id="data-tabel">
                <div class="table-responsive">
                    <div class="load-content text-center">Memuat data... <span><i class="fa fa-spinner fa-spin"></i></span></div>
                    <table id="tabel-karyawan" class="display" cellspacing="0" width="100%"></table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@include('pages.karyawan.modal')

@push('after-script')
@include('pages.karyawan.script')
@endpush