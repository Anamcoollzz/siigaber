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
        <th>Aksi</th>
    </tr>
</thead>
<tfoot>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Username</th>
        <th>Role</th>
        <th>Aksi</th>
    </tr>
</tfoot>
<tbody>
    @foreach ($data as $d)
    <tr>
        <td>{{ $d->id }}</td>
        <td>{{ $d->nama }}</td>
        <td>{{ $d->username }}</td>
        <td>{{ $d->role }}</td>
        <td>
            @include('edit_button', ['link' => route('akun.edit', [$d->id])])
            {{-- @include('delete_button', ['link' => route('akun.destroy', [$d->id])]) --}}
        </td>
    </tr>
    @endforeach
</tbody>
@endsection