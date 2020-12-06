@extends('layouts.default')

@section('content')
<div class="animated fadeIn row">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="box-title" style="margin-top: 10px;margin-bottom: -10px">Stok Opname</h3>
                </div>
                <div class="col-md-4">
                    <a style="color:white;" class="pull-right" href="{{ route('stok-opname.create') }}">
                        <span class="circle circle-sm bg-success di" title="Tambah Stok Opname" data-placement="bottom"><i class="ti-plus"></i></span>
                    </a>
                </div>
            </div>
            <hr>
            <div id="data-tabel">
                <div class="table-responsive">
                    <div class="load-content text-center">Memuat data... <span><i class="fa fa-spinner fa-spin"></i></span></div>
                    <table id="tabel-stok-opname" class="display" cellspacing="0" width="100%"></table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@include('pages.stok-opname.modal')

@push('after-script')
@include('pages.stok-opname.script')
@endpush