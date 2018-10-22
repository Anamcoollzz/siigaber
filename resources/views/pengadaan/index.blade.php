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
        <th>Status</th>
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
        <th>Status</th>
        <th>Aksi</th>
    </tr>
</tfoot>
<tbody>
    @foreach ($data as $d)
    <tr>
        <td>{{ $d->id }}</td>
        <td>{{ $d->tanggal }}</td>
        <td>{{ $d->jenis_pengadaan }}</td>
        <td align="right">{{ angka($d->jumlah) }}</td>
        <td align="right">{{ number_format($d->biaya, 0, ',', '.') }}</td>
        <td align="right">{{ number_format($d->biaya_transport, 0, ',', '.') }}</td>
        <td>
            @if($d->status == 'Menunggu persetujuan')
            <span class="label bg-red">{{$d->status}}</span>
            @elseif($d->status == 'Dalam pengerjaan')
            <span class="label bg-yellow">{{$d->status}}</span>
            @endif
        </td>
        <td>
            @include('detail_button', ['link' => route('pengadaan.show', [$d->id])])
            @if($d->status == 'Menunggu persetujuan')
            @include('edit_button', ['link' => route('pengadaan.edit', [$d->id])])
            @include('delete_button', ['link' => route('pengadaan.destroy', [$d->id])])
            <a href="#" onclick="verifikasi(event, '{{route('pengadaan.verifikasi',[$d->id])}}')" class="btn btn-flat btn-warning">Verifikasi</a>
            @endif
        </td>
    </tr>
    @endforeach
</tbody>
@endsection

@push('script')
<form action="" id="verifikasi-form" method="post">
    @csrf
    @method('put')
</form>
<script>
    function verifikasi(e, link) {
        e.preventDefault();
        if(confirm('Anda yakin?')){
            var form = document.getElementById('verifikasi-form');
            form.action = link;
            form.submit();
        }
    }
</script>
@endpush