@extends('my-view')
@section('table')
<thead>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Lokasi</th>
        <th>Kapasitas</th>
        <th>Jumlah Beras</th>
        <th>Jumlah Gabah</th>
        <th>Aksi</th>
    </tr>
</thead>
<tfoot>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Lokasi</th>
        <th>Kapasitas</th>
        <th>Jumlah Beras</th>
        <th>Jumlah Gabah</th>
        <th>Aksi</th>
    </tr>
</tfoot>
<tbody>
    @foreach ($data as $d)
    <tr>
        <td>{{ $d->id }}</td>
        <td>{{ $d->nama }}</td>
        <td>{{ $d->lokasi }}</td>
        <td align="right">{{ angka($d->kapasitas) }}</td>
        <td align="right">{{ angka($d->detail->sum(function($item){return $item->jml_beras;})) }}</td>
        <td align="right">{{ angka($d->detail->sum(function($item){return $item->jml_gabah;})) }}</td>
        <td>
            @include('detail_button', ['link' => route('gudang.show', [$d->id])])
            @if(Auth::user()->role == 'Operator')
            @include('edit_button', ['link' => route('gudang.edit', [$d->id])])
            @include('delete_button', ['link' => route('gudang.destroy', [$d->id])])
            @endif
        </td>
    </tr>
    @endforeach
</tbody>
@endsection