@extends('my-view')
@section('table')
<thead>
    <tr>
        <th>ID</th>
        <th>Tanggal</th>
        <th>Jenis</th>
        <th>Jumlah</th>
        <th>Biaya</th>
        <th>Biaya Transport</th>
        <th>Aksi</th>
    </tr>
</thead>
<tfoot>
    <tr>
        <th>ID</th>
        <th>Tanggal</th>
        <th>Jenis</th>
        <th>Jumlah</th>
        <th>Biaya</th>
        <th>Biaya Transport</th>
        <th>Aksi</th>
    </tr>
</tfoot>
<tbody>
    @foreach ($data as $d)
    <tr>
        <td>{{ $d->id }}</td>
        <td>{{ $d->tanggal }}</td>
        <td>{{ $d->jenis }}</td>
        <td>{{ $d->jumlah }}</td>
        <td align="right">{{ number_format($d->biaya, 0, ',', '.') }}</td>
        <td align="right">{{ number_format($d->biaya_transport, 0, ',', '.') }}</td>
        <td>
            @include('edit_button', ['link' => route('mitra-kerja.edit', [$d->id])])
        </td>
    </tr>
    @endforeach
</tbody>
@endsection