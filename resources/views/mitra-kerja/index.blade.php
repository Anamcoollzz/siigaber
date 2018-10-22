@extends('my-view')
@section('table')
<thead>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Bidang</th>
        <th>Kontak</th>
        <th>Deskripsi</th>
<th>Alamat</th>
        <th>Aksi</th>
    </tr>
</thead>
<tfoot>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Bidang</th>
        <th>Kontak</th>
        <th>Deskripsi</th>
<th>Alamat</th>
        <th>Aksi</th>
    </tr>
</tfoot>
<tbody>
    @foreach ($data as $d)
    <tr>
        <td>{{ $d->id }}</td>
        <td>{{ $d->nama }}</td>
        <td>{{ $d->bidang }}</td>
        <td>{{ $d->kontak }}</td>
        <td>{{ $d->deskripsi }}</td>
        <td>{{ $d->alamat }}</td>
        <td>
            @include('edit_button', ['link' => route('mitra-kerja.edit', [$d->id])])
            @include('delete_button', ['link' => route('mitra-kerja.destroy', [$d->id])])
        </td>
    </tr>
    @endforeach
</tbody>
@endsection