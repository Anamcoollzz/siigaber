@extends('my-view')
@section('table')
<thead>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Lokasi</th>
        <th>Kapasitas</th>
        <th>Aksi</th>
    </tr>
</thead>
<tfoot>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Lokasi</th>
        <th>Kapasitas</th>
        <th>Aksi</th>
    </tr>
</tfoot>
<tbody>
    @foreach ($data as $d)
    <tr>
        <td>{{ $d->id }}</td>
        <td>{{ $d->nama }}</td>
        <td>{{ $d->lokasi }}</td>
        <td>{{ $d->kapasitas }}</td>
        <td>
            @include('edit_button', ['link' => route('gudang.edit', [$d->id])])
            @include('delete_button', ['link' => route('gudang.destroy', [$d->id])])
        </td>
    </tr>
    @endforeach
</tbody>
@endsection