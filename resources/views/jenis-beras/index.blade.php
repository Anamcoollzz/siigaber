@extends('my-view')
@section('table')
<thead>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        @if(Auth::user()->role == 'Operator')
        <th>Aksi</th>
        @endif
    </tr>
</thead>
<tfoot>
    <tr>
        <th>ID</th>
        <th>Nama</th>
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
        @if(Auth::user()->role == 'Operator')
        <td>
            @include('edit_button', ['link' => route('jenis-beras.edit', [$d->id])])
            @include('delete_button', ['link' => route('jenis-beras.destroy', [$d->id])])
        </td>
        @endif
    </tr>
    @endforeach
</tbody>
@endsection