@if (count($datas) === 0)
<div class="text-center">
    <h5>Belum ada daftar harga untuk <strong>{{ $namaBarang }}</strong>.</h5>
</div>
@else
<table id="daftar-harga" class="table">
    <thead>
        <th class="text-center">Tanggal</th>
        <th class="text-center">Harga {{ ($jenis == 1) ? "Beli" : "Jual" }}</th>
        <th class="text-center">Keterangan</th>
    </thead>
    <tbody>
        @foreach ($datas as $item)
        <tr>
            <td class="text-center">{{ date('d F Y', strtotime($item->created_at)) }}</td>
            <td class="text-center">{{ number_format($item->harga, 0) }}</td>
            <td class="text-left">{{ $item->ket }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
