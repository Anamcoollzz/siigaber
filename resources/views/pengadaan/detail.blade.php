@extends('app.box')
@section('box')
@component('box',['title'=>$title])
<table class="table">
	<tbody>
		<tr>
			<td>Tanggal</td>
			<td>:</td>
			<td>{{$d->tanggal}}</td>
		</tr>
		<tr>
			<td>Jenis</td>
			<td>:</td>
			<td>{{$d->jenis_pengadaan}}</td>
		</tr>
		<tr>
			<td>Jumlah</td>
			<td>:</td>
			<td>{{angka($d->jumlah)}}</td>
		</tr>
		<tr>
			<td>Biaya</td>
			<td>:</td>
			<td>{{number_format($d->biaya, 0, ',', '.')}}</td>
		</tr>
		<tr>
			<td>Biaya Transport</td>
			<td>:</td>
			<td>{{number_format($d->biaya_transport, 0, ',', '.')}}</td>
		</tr>
		<tr>
			<td>Mitra Kerja</td>
			<td>:</td>
			<td>{{$d->mitrakerja->nama}}</td>
		</tr>
		<tr>
			<td>Status</td>
			<td>:</td>
			<td>
				@if($d->status == 'Menunggu persetujuan')
				<span class="label bg-red">{{$d->status}}</span>
				@elseif($d->status == 'Dalam pengerjaan')
				<span class="label bg-yellow">{{$d->status}}</span>
				@endif
			</td>
		</tr>
		@foreach ($d->kegudang as $g)
		<tr>
			<td>{{$g->gudang->nama}}</td>
			<td>:</td>
			<td>{{angka($g->jumlah)}}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endcomponent
@endsection