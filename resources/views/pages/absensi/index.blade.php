@extends('layouts.default')

@section('content')
<div class="animated fadeIn row">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="box-title" style="margin-top: 10px;margin-bottom: -10px">Absensi</h3>
                </div>
            </div>
            <hr>
            <div id="data-tabel">
                <div class="table-responsive">
                    <div class="load-content text-center">Memuat data... <span><i class="fa fa-spinner fa-spin"></i></span></div>
                    <table id="tabel-absensi" class="display" cellspacing="0" width="100%"></table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@include('pages.absensi.modal')

@push('after-script')
@include('pages.absensi.script')
@endpush