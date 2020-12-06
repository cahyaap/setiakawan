@extends('layouts.default')

@section('content')
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-lg-3 col-sm-3 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Stok Barang</h3>
                            <div class="text-right">
                                <span class="text-muted">Total Barang</span>
                                <h1><sup><i class="fa fa-cube text-success"></i></sup> {{ number_format($barang, 0) }} jenis</h1>
                                <span class="text-muted">Tonase: {{ number_format($barangTonase, 0) }} kg</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Total Penjualan</h3>
                            <div class="text-right">
                                <span class="text-muted">Hari Ini</span>
                                <h1><sup><i class="ti-arrow-up text-success"></i></sup> {{ number_format($penjualan['harga'], 0) }}</h1>
                                <span class="text-muted">Tonase: {{ number_format($penjualan['kg'], 0) }} kg</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Total Pembelian</h3>
                            <div class="text-right">
                                <span class="text-muted">Hari Ini</span>
                                <h1><sup><i class="ti-arrow-down text-danger"></i></sup> {{ number_format($pembelian['harga'], 0) }}</h1>
                                <span class="text-muted">Tonase: {{ number_format($pembelian['kg'], 0) }} kg</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Total Pengeluaran</h3>
                            <div class="text-right">
                                <span class="text-muted">Hari Ini</span>
                                <h1><sup><i class="ti-money text-danger"></i></sup> {{ number_format($pembelian['harga']+$pengeluaran, 0) }}</h1>
                                <span class="text-muted">Pembelian dan Pengeluaran lainnya</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Transaksi Terakhir</h3>
                            <div class="row sales-report">
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <h2>{{ date('l, d F Y', strtotime(now())) }}</h2>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Kode</th>
                                            <th class="text-center">Seller</th>
                                            <th class="text-center">Total</th>
                                            <th class="text-center">Jenis</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaksis as $item)
                                        <tr>
                                            <td class="txt-oflo text-center">
                                                <a class='detail-btn' alt='Detail' title='Detail' href='#detailTransaksi' data-jenis='{{ $item->jenis }}' data-aksi='detail' data-id='{{ $item->id }}' data-toggle='modal' data-target='#detailTransaksi'>{{ $item->kode }}</a>
                                            </td>
                                            <td class="txt-oflo">{{ $item->seller->name }}</td>
                                            <td class="txt-oflo text-right">{{ number_format($item->detail[0]->total, 0) }}</td>
                                            <td class="text-center">
                                                @if ($item->jenis == 1)
                                                <span class="label label-success label-rouded">Pembelian</span>
                                                @endif
                                                @if ($item->jenis == 2)
                                                <span class="label label-warning label-rouded">Penjualan</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a class='btn btn-sm btn-success print-btn' alt='Print' title='Print' href='#printTransaksi'><span><i class='fa fa-print'></i></span></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Stok Barang Habis</h3>
                            <div class="table-responsive">
                                <table class="table stok-habis">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Kategori</th>
                                            <th class="text-center">Kode</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Tonase (Stok)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($stokHabis as $item)
                                        <tr>
                                            <td>{{ $item->kategori->name }}</td>
                                            <td>{{ $item->kode }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td class="text-center">{{ number_format($item->stok, 2) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-script')
<script type="text/javascript">
    $('.stok-habis').DataTable({
        "order": [[ 0, "asc" ],[ 2, "asc" ]]
    });
    $('.stok-habis').removeClass('dataTable');
</script>
@endpush