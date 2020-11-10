@if (count($datas) === 0)
<div class="text-center">
    <h5>Belum ada daftar harga untuk <strong>{{ $namaBarang }}</strong>.</h5>
</div>
@else
<table id="daftar-harga" class="table">
    <thead>
        <th class="text-center">Beli</th>
        <th class="text-center">Jual</th>
        <th class="text-center">Keterangan</th>
    </thead>
    <tbody>
        @foreach ($datas as $item)
        <tr>
            <td class="text-center">{{ number_format($item->beli, 0) }}</td>
            <td class="text-center">{{ number_format($item->jual, 0) }}</td>
            <td>{{ $item->ket }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
