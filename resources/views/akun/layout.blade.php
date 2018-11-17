@extends('my-view')
@section('other-box')
@yield('filter')
@endsection
@section('table')
<thead>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Username</th>
        <th>Role</th>
        @if(Auth::user()->role == 'Operator')
        <th>Aksi</th>
        @endif
    </tr>
</thead>
<tfoot>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Username</th>
        <th>Role</th>
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
        <td>{{ $d->username }}</td>
        <td>{{ $d->role }}</td>
        @if(Auth::user()->role == 'Operator')
        <td>
            @include('edit_button', ['link' => route('akun.edit', [$d->id])])
            @include('delete_button', ['link' => route('akun.destroy', [$d->id])])
        </td>
        @endif
    </tr>
    @endforeach
</tbody>
@endsection