@extends('layouts.default')

@section('content')
<div class="animated fadeIn row">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="box-title" style="margin-top: 10px;margin-bottom: -10px">Absensi<span id="waktu-absensi"></span></h3>
                </div>
            </div>
            <hr>
            <div class="row">
                <form id="filter-absensi">
                    <div class="col-md-12">
                        <label for="tanggal">Tanggal</label>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="date" name="tanggal" id="tanggal" value="{{ date('Y-m-d', strtotime(now())) }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-block btn-info" id="lihat-absensi"><span><i class="fa fa-search"></i></span></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="form-group" id="data-tabel">
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