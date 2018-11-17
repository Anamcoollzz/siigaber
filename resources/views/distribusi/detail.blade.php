@extends('app.box')

@section('breadcrumb')

<section class="content-header">
	<h1>
		{{$title}}
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?=url('')?>"><i class="fa fa-dashboard"></i> Dasbor</a></li>
		<li><a href="{{route('distribusi.index')}}"> Distribusi</a></li>
		<li class="active"><?=$title?></li>
	</ol>
</section>

@endsection

@section('box')
@component('box',['title'=>$title])
<table class="table">
	<tbody>
		<tr>
			<td>Tanggal Dibuat</td>
			<td>:</td>
			<td>{{$d->created_at}}</td>
		</tr>
		<tr>
			<td>Tanggal Mulai</td>
			<td>:</td>
			<td>{{$d->tanggal_mulai}}</td>
		</tr>
		@if($d->tanggal_selesai)
		<tr>
			<td>Tanggal Selesai</td>
			<td>:</td>
			<td>{{$d->tanggal_selesai}}</td>
		</tr>
		@endif
		<tr>
			<td>Jenis Beras</td>
			<td>:</td>
			<td>{{$d->jenis->nama}}</td>
		</tr>
		@foreach ($d->detail as $detail)
		<tr>
			<td>Dari {{ $detail->gudang->nama }}</td>
			<td>:</td>
			<td>{{angka($detail->jumlah)}}</td>
		</tr>
		@endforeach
		<tr>
			<td>Total yang didistribusikan</td>
			<td>:</td>
			<td>{{angka($d->detail->sum(function($item){return $item->jumlah;}))}}</td>
		</tr>
		<tr>
			<td>Biaya</td>
			<td>:</td>
			<td>{{number_format($d->biaya, 0, ',', '.')}}</td>
		</tr>
		@if($d->status == 'Selesai')
		<tr>
			<td>Biaya Transportasi</td>
			<td>:</td>
			<td>{{number_format($d->biaya_transport, 0, ',', '.')}}</td>
		</tr>
		@endif
		<tr>
			<td>Tipe</td>
			<td>:</td>
			<td>{{$d->tipe}}</td>
		</tr>
		@if($d->tipe == 'Umum')
		<tr>
			<td>Mitra Kerja</td>
			<td>:</td>
			<td>{{$d->mitrakerja->nama}}</td>
		</tr>
		@else
		<tr>
			<td>Nama Desa</td>
			<td>:</td>
			<td>{{$d->nama_desa}}</td>
		</tr>
		<tr>
			<td>Nama Kecamatan</td>
			<td>:</td>
			<td>{{$d->nama_kecamatan}}</td>
		</tr>
		<tr>
			<td>Nama Kepala Desa</td>
			<td>:</td>
			<td>{{$d->nama_kepala_desa}}</td>
		</tr>
		@endif
		<tr>
			<td>Status</td>
			<td>:</td>
			<td>
				@if($d->status == 'Menunggu persetujuan')
				<span class="label bg-red">{{$d->status}}</span>
				@elseif($d->status == 'Dalam pengerjaan')
				<span class="label bg-yellow">{{$d->status}}</span>
				@elseif($d->status == 'Selesai')
				<span class="label bg-green">{{$d->status}}</span>
				@endif
			</td>
		</tr>
	</tbody>
</table>
@if($d->status == 'Menunggu persetujuan')
@if(Auth::user()->role == 'Operator')
@include('edit_button', ['link' => route('distribusi.edit', [$d->id])])
@include('delete_button', ['link' => route('distribusi.destroy', [$d->id])])
@endif
@if(Auth::user()->role == 'Manajer')
<a href="#" onclick="verifikasi(event, '{{route('distribusi.verifikasi',[$d->id])}}')" class="btn btn-flat btn-warning">Verifikasi</a>
@endif
@endif
@endcomponent
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