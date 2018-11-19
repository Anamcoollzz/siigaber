@extends('app.box')

@section('breadcrumb')

<section class="content-header">
	<h1>
		{{$title}}
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?=url('')?>"><i class="fa fa-dashboard"></i> Dasbor</a></li>
		<li><a href="{{route('pengadaan.index')}}"> Pengadaan</a></li>
		<li class="active"><?=$title?></li>
	</ol>
</section>

@endsection

@section('box')
@component('box',['title'=>$title])
<table class="table">
	<tbody>
		<tr>
			<td><strong>Waktu Dibuat</strong></td>
			<td>:</td>
			<td>{{$d->created_at}}</td>
		</tr>
		<tr>
			<td><strong>Tanggal Pengadaan</strong></td>
			<td>:</td>
			<td>{{$d->tanggal}}</td>
		</tr>
		@if($d->tanggal_selesai)
		<tr>
			<td><strong>Tanggal Sampai</strong></td>
			<td>:</td>
			<td>{{$d->tanggal_selesai}}</td>
		</tr>
		@endif
		<tr>
			<td><strong>Jenis Pengadaan</strong></td>
			<td>:</td>
			<td>{{$d->jenis_pengadaan}}</td>
		</tr>
		<tr>
			<td><strong>Jenis Beras</strong></td>
			<td>:</td>
			<td>{{$d->jenis->nama}}</td>
		</tr>
		{{-- <tr>
			<td><strong>Jumlah</strong></td>
			<td>:</td>
			<td>{{angka($d->jumlah)}}</td>
		</tr> --}}
		<tr>
			<td><strong>Biaya</strong></td>
			<td>:</td>
			<td>{{number_format($d->biaya, 0, ',', '.')}}</td>
		</tr>
		@if($d->status == 'Selesai')
		<tr>
			<td><strong>Biaya Transportasi</strong></td>
			<td>:</td>
			<td>{{number_format($d->biaya_transport, 0, ',', '.')}}</td>
		</tr>
		@endif
		<tr>
			<td><strong>Mitra Kerja</strong></td>
			<td>:</td>
			<td>{{$d->mitrakerja->nama}}</td>
		</tr>
		<tr>
			<td><strong>Status</strong></td>
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
		@foreach ($d->kegudang as $g)
		<tr>
			<td><strong>Masuk ke {{$g->gudang->nama}}</strong></td>
			<td>:</td>
			<td>{{angka($g->jumlah)}}</td>
		</tr>
		@endforeach
		<tr>
			<td><strong>Total</strong></td>
			<td>:</td>
			<td>{{angka($d->kegudang->sum('jumlah'))}}</td>
		</tr>
	</tbody>
</table>
@if($d->status == 'Menunggu persetujuan')
@if(Auth::user()->role == 'Operator')
@include('edit_button', ['link' => route('pengadaan.edit', [$d->id])])
@include('delete_button', ['link' => route('pengadaan.destroy', [$d->id])])
@endif
@if(Auth::user()->role == 'Manajer')
<a href="#" onclick="verifikasi(event, '{{route('pengadaan.verifikasi',[$d->id])}}')" class="btn btn-flat btn-warning">Verifikasi</a>
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