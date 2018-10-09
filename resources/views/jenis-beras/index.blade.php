@extends('my-view')
@section('table')
<thead>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Aksi</th>
    </tr>
</thead>
<tfoot>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Aksi</th>
    </tr>
</tfoot>
<tbody>
    @foreach ($data as $d)
    <tr>
        <td>{{ $d->id }}</td>
        <td>{{ $d->nama }}</td>
        <td>
            @include('edit_button', ['link' => route('jenis-beras.edit', [$d->id])])
        </td>
    </tr>
    @endforeach
</tbody>
@endsection