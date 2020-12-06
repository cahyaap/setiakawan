<tr row-id="{{ $rowId }}" class="data-barang">
    <td class="text-center">{{ $rowId + 1 }}</td>
    <td>
        <input type="text" list="nama-barang-{{ $rowId }}" nama="nama[]" id="nama-{{ $rowId }}" class="form-control nama-barang">
        <input type="hidden" name="barang_id[]" id="barang-id-{{ $rowId }}" class="form-control barang-id">
        <span class="nama-barang-alert" id="nama-barang-{{ $rowId }}-alert"></span>
        <datalist id="nama-barang-{{ $rowId }}">
            @foreach ($barangs as $item)
            <option data-id="{{ $item->id }}" value="{{ $item->name }}">
            @endforeach
        </datalist>
    </td>
    <td>
        <input type="number" name="harga[]" id="harga-{{ $rowId }}" class="form-control text-right harga-barang">
        <span class="daftar-harga" id="daftar-harga-{{ $rowId }}" data-toggle="modal" data-target="#daftarHarga"></span>
    </td>
    <td><input type="number" name="kg[]" id="kg-{{ $rowId }}" class="form-control text-right berat-barang"></td>
    <td><input type="number" name="total[]" id="total-{{ $rowId }}" readonly class="form-control text-right total-barang"></td>
</tr>