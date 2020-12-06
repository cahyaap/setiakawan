@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="box-title" style="margin-top: 10px;margin-bottom: -10px">Detail Stok Opname - {{ date('d F Y, h:i:s A', strtotime($stokOpname->created_at)) }}</h3>
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
                    <div class="form-group">
                        <table id="tabel-detail-stok-opname" class="display" cellspacing="0" width="100%">
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
                                    $totalStokWeb = 0;
                                    $totalStokReal = 0;
                                    $totalSelisih = 0;
                                @endphp
                                @foreach ($barangs as $item)
                                @php
                                    $stokWeb = 0;
                                    $stokReal = 0;
                                    if(count($item->stokOpname) > 0){
                                        $stokWeb = $item->stokOpname[0]->stok_web;
                                        $stokReal = $item->stokOpname[0]->stok_real;
                                        $totalStokWeb += $stokWeb;
                                        $totalStokReal += $stokReal;
                                        $totalSelisih += $stokReal - $stokWeb;
                                    }
                                @endphp
                                <tr>
                                    <td>{{ $item->kategori->name }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td class="text-center">{{ number_format($stokWeb, 2) }}</td>
                                    <td class="text-center">{{ number_format($stokReal, 2) }}</td>
                                    <td class="text-center" id="selisih-{{ $item->id }}">{{ number_format($stokReal-$stokWeb, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <th class="text-center" colspan="2">Total</th>
                                <th class="text-center">{{ number_format($totalStokWeb, 2) }}</th>
                                <th class="text-center" id="total-real">{{ number_format($totalStokReal, 2) }}</th>
                                <th class="text-center" id="total-selisih">{{ number_format($totalSelisih, 2) }}</th>
                            </tfoot>
                        </table>
                    </div>
                    <div class="form-group">
                        <label for="ket">Keterangan</label>
                        <div>{{ $stokOpname->ket }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-script')
@include('pages.stok-opname.script')
@endpush