@extends('app.box')

@section('breadcrumb')

<section class="content-header">
	<h1>
		{{$title}}
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?=url('')?>"><i class="fa fa-dashboard"></i> Dasbor</a></li>
		<li><a href="{{route('gudang.index')}}"> Gudang</a></li>
		<li class="active"><?=$title?></li>
	</ol>
</section>

@endsection

@section('box')
@component('box',['title'=>$title])
<table class="table">
	<tbody>
		<tr>
			<td><strong>ID</strong></td>
			<td>:</td>
			<td>{{ $d->id }}</td>
		</tr>
		<tr>
			<td><strong>Nama</strong></td>
			<td>:</td>
			<td>{{ $d->nama }}</td>
		</tr>
		<tr>
			<td><strong>Lokasi</strong></td>
			<td>:</td>
			<td>{{ $d->lokasi }}</td>
		</tr>
		<tr>
			<td><strong>Kapasitas</strong></td>
			<td>:</td>
			<td>{{ angka($d->kapasitas) }} kg</td>
		</tr>
		<tr>
			<td><strong>Beras</strong></td>
			<td>:</td>
			<td>
				<table class="table table-striped table-bordered">
					<tbody>
						@foreach ($d->detail as $a)
						<tr>
							<td>{{$a->jenis->nama}}</td> 
							<td>:</td> 
							<td>{{angka($a->jml_beras)}} kg</td>
						</tr>
						@endforeach
						<tr>
							<td>Total</td>
							<td>:</td>
							<td>{{ angka($d->detail->sum(function($item){return $item->jml_beras;})) }} kg</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td><strong>Gabah</strong></td>
			<td>:</td>
			<td>
				<table class="table table-striped table-bordered">
					<tbody>
						@foreach ($d->detail as $a)
						<tr>
							<td>{{$a->jenis->nama}}</td> 
							<td>:</td> 
							<td>{{angka($a->jml_gabah)}} kg</td>
						</tr>
						@endforeach
						<tr>
							<td>Total</td>
							<td>:</td>
							<td>{{ angka($d->detail->sum(function($item){return $item->jml_gabah;})) }} kg</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
</table>
<center>
	@if(Auth::user()->role == 'Operator')
	@include('edit_button', ['link' => route('gudang.edit', [$d->id])])
	@include('delete_button', ['link' => route('gudang.destroy', [$d->id])])
	@endif
</center>
@endcomponent
@endsection