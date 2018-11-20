@extends('my-view')
@section('table')
<thead>
    <tr>
        <th>ID</th>
        <th>Waktu Dibuat</th>
        <th>Teratas</th>
        <th>Keterangan</th>
        <th>Aksi</th>
    </tr>
</thead>
<tfoot>
    <tr>
        <th>ID</th>
        <th>Waktu Dibuat</th>
        <th>Teratas</th>
        <th>Keterangan</th>
        <th>Aksi</th>
    </tr>
</tfoot>
<tbody>
    @foreach ($data as $d)
    <tr>
        <td>{{ $d->id }}</td>
        <td>{{ $d->created_at }}</td>
        <td>{{$d->teratas}}</td>
        <td>{{$d->keterangan}}</td>
        <td>
            
        </td>
    </tr>
    @endforeach
</tbody>
@endsection