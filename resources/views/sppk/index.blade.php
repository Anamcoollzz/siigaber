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
            @if($d->id_teratas)
            <a href="{{ route('hasil',[$d->id]) }}" class="btn btn-primary btn-flat">Hasil</a>
            @endif
        </td>
    </tr>
    @endforeach
</tbody>
@endsection