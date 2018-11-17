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
			<td>Waktu Dibuat</td>
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
			<td>{{angka($detail->jumlah)}} kg</td>
		</tr>
		@endforeach
		<tr>
			<td>Total yang didistribusikan</td>
			<td>:</td>
			<td>{{angka($d->detail->sum(function($item){return $item->jumlah;}))}} kg</td>
		</tr>
		<tr>
			<td>Biaya</td>
			<td>:</td>
			<td>Rp. {{number_format($d->biaya, 0, ',', '.')}}</td>
		</tr>
		@if($d->status == 'Selesai')
		<tr>
			<td>Biaya Transportasi</td>
			<td>:</td>
			<td>Rp. {{number_format($d->biaya_transport, 0, ',', '.')}}</td>
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


@if($d->status == 'Dalam pengerjaan' && Auth::user()->role == 'Operator')
<a data-toggle="modal" data-target="#modal-selesai-{{$d->id}}" class="btn bg-maroon btn-flat">Selesai</a>
<form action="{{ route('distribusi.selesai',[$d->id]) }}" method="post" role="form" class="form-horizontal">
	<div class="modal fade" id="modal-selesai-{{$d->id}}" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">Selesai Distribusi</h4>
				</div>
				<div class="modal-body">
					@csrf
					@method('put')
					<input type="hidden" name="id_penggilingan" value="{{$d->id}}">
					<div class="row">
						<div class="form-group {{$errors->has('biaya_transport' ? 'has-error' : '')}}">
							<label for="biaya_transport" class="col-sm-4 control-label">Biaya Transportasi</label>
							<div class="col-sm-6">
								<input required="required" name="biaya_transport" value="{{old('biaya_transport')}}" type="number" class="form-control" id="biaya_transport" placeholder="Biaya Transportasi">
								@if($errors->has('biaya_transport'))
								<span class="help-block">{{$errors->first('biaya_transport')}}</span>
								@endif
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left btn-flat" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary btn-flat">Selesai</button>
				</div>
			</div>
		</div>
	</div>
</form>
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