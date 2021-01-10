@extends('layouts.default')

@section('content')
<div class="animated fadeIn row">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="box-title" style="margin-top: 10px;margin-bottom: -10px">Rekap <span id="jenis-rekap"></span></h3>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="rekap">Rekap</label>
                        <select name="rekap" id="rekap" class="form-control">
                            <option value="harian">Harian</option>
                            <option value="mingguan">Mingguan</option>
                            <option value="bulanan">Bulanan</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="jenis">Jenis Transaksi</label>
                        <select name="jenis" id="jenis" class="form-control">
                            <option value="1">Pembelian</option>
                            <option value="2">Penjualan</option>
                        </select>
                    </div>
                </div>
            </div>

            @php
                function weekOfMonth($date) {
                    $firstOfMonth = strtotime(date("Y-m-01", $date));
                    return intval(date("W", $date)) - intval(date("W", $firstOfMonth)) + 1;
                }
                $now = date('Y-m-d', strtotime(now()));
                $month = date('m', strtotime(now()));
                $tahun = (int) date('Y', strtotime(now()));
                $week = weekOfMonth(strtotime(now()));
            @endphp

            <div class="row rekap-filter" id="rekap-harian">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ $now }}">
                    </div>
                </div>
            </div>

            <div class="row rekap-filter" id="rekap-mingguan" style="display: none;">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bulan-mingguan">Bulan</label>
                        <select name="bulan" id="bulan-mingguan" class="form-control">
                            <option value="01" @if ($month == "01") selected @endif>Januari</option>
                            <option value="02" @if ($month == "02") selected @endif>Februari</option>
                            <option value="03" @if ($month == "03") selected @endif>Maret</option>
                            <option value="04" @if ($month == "04") selected @endif>April</option>
                            <option value="05" @if ($month == "05") selected @endif>Mei</option>
                            <option value="06" @if ($month == "06") selected @endif>Juni</option>
                            <option value="07" @if ($month == "07") selected @endif>Juli</option>
                            <option value="08" @if ($month == "08") selected @endif>Agustus</option>
                            <option value="09" @if ($month == "09") selected @endif>September</option>
                            <option value="10" @if ($month == "10") selected @endif>Oktober</option>
                            <option value="11" @if ($month == "11") selected @endif>November</option>
                            <option value="12" @if ($month == "12") selected @endif>Desember</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tahun-mingguan">Tahun</label>
                        <select name="tahun" id="tahun-mingguan" class="form-control">
                            @for ($i = $tahun; $i > $tahun - 3; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="minggu">Minggu ke</label>
                        <select name="minggu" id="minggu" class="form-control">
                            <option value="1" @if ($week == 1) selected @endif>1</option>
                            <option value="2" @if ($week == 2) selected @endif>2</option>
                            <option value="3" @if ($week == 3) selected @endif>3</option>
                            <option value="4" @if ($week == 4) selected @endif>4</option>
                            <option value="5" @if ($week == 5) selected @endif>5</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row rekap-filter" id="rekap-bulanan" style="display: none;">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bulan-bulanan">Bulan</label>
                        <select name="bulan" id="bulan-bulanan" class="form-control">
                            <option value="01" @if ($month == "01") selected @endif>Januari</option>
                            <option value="02" @if ($month == "02") selected @endif>Februari</option>
                            <option value="03" @if ($month == "03") selected @endif>Maret</option>
                            <option value="04" @if ($month == "04") selected @endif>April</option>
                            <option value="05" @if ($month == "05") selected @endif>Mei</option>
                            <option value="06" @if ($month == "06") selected @endif>Juni</option>
                            <option value="07" @if ($month == "07") selected @endif>Juli</option>
                            <option value="08" @if ($month == "08") selected @endif>Agustus</option>
                            <option value="09" @if ($month == "09") selected @endif>September</option>
                            <option value="10" @if ($month == "10") selected @endif>Oktober</option>
                            <option value="11" @if ($month == "11") selected @endif>November</option>
                            <option value="12" @if ($month == "12") selected @endif>Desember</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tahun-bulanan">Tahun</label>
                        <select name="tahun" id="tahun-bulanan" class="form-control">
                            @for ($i = $tahun; $i > $tahun - 3; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>

            {{-- <div class="row">
                <div class="col-md-12">
                    <div class="form-group text-center">
                        <button type="button" id="lihat-rekap" class="btn btn-primary">Lihat Rekap</button>
                    </div>
                </div>
            </div> --}}
            <hr>
            <div class="row" id="data-tabel">
                <div class="col-md-12 table-responsive">
                    <div class="load-content text-center">Memuat data... <span><i class="fa fa-spinner fa-spin"></i></span></div>
                    <div id="rekap-container">
                        <table id="tabel-rekap" class="display" cellspacing="0" width="100%"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@include('pages.rekap.modal')

@push('after-script')
@include('pages.rekap.script')
@endpush