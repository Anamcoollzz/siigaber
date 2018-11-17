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
        @if(Auth::user()->role == 'Operator')
        <th>Aksi</th>
        @endif
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
        @if(Auth::user()->role == 'Operator')
        <th>Aksi</th>
        @endif
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
        @if(Auth::user()->role == 'Operator')
        <td>
            @include('edit_button', ['link' => route('mitra-kerja.edit', [$d->id])])
            @include('delete_button', ['link' => route('mitra-kerja.destroy', [$d->id])])
        </td>
        @endif
    </tr>
    @endforeach
</tbody>
@endsection