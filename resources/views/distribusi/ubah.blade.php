@extends('create-form')
@section('form')
@method('PUT')
@include('datepicker',['id'=>'tanggal_mulai','label'=>'Tanggal Mulai','value'=>$d->tanggal_mulai,'required'=>true])
@include('select',['id'=>'id_jenis_beras','label'=>'Pilih Jenis Beras','selectData'=>$listJenisBeras,'selected'=>$d->id_jenis_beras])

<div class="form-group">
	<label for="inputEmail3" class="col-sm-2 control-label">Pilih Tipe</label>

	<div class="col-sm-10">
		<div style="margin-top: 6px;">
			<input 
			@if(old('tipe'))
			@if(old('tipe') == 'Umum')
			checked="checked" 
			@endif
			@else
			@if($d->tipe == 'Umum')
			checked="checked" 
			@endif
			@endif 
			value="Umum" id="tipe-umum" name="tipe" type="radio" class="minimal" >&nbsp;&nbsp;
			Umum
			&nbsp;&nbsp;&nbsp;
			<input 
			@if(old('tipe'))
			@if(old('tipe') == 'Raskin')
			checked="checked" 
			@endif
			@else
			@if($d->tipe == 'Raskin')
			checked="checked" 
			@endif
			@endif 
			value="Raskin" id="tipe-raskin" name="tipe" type="radio" class="minimal" >&nbsp;&nbsp;
			Raskin
		</div>
	</div>
</div>

<div id="mitra-kerja-area" @if($d->tipe == 'Raskin') style="display: none;" @endif>
	@include('select',['id'=>'id_mitra_kerja','label'=>'Pilih Mitra Kerja','selectData'=>$listMitraKerja])
</div>

<div @if($d->tipe == 'Umum') style="display: none;" @endif id="raskin-area">

	@include('input',['id'=>'nama_desa','label'=>'Nama Desa','value'=>$d->nama_desa])
	@include('input',['id'=>'nama_kecamatan','label'=>'Nama Kecamatan','value'=>$d->nama_kecamatan])
	@include('input',['id'=>'nama_kepala_desa','label'=>'Nama Kepala Desa','value'=>$d->nama_kepala_desa])

</div>

<div class="form-group">
	<label for="kkk" class="col-sm-2 control-label">Pilih Gudang</label>
	<div class="col-md-10" style="margin-top: 7px;">
		@foreach ($gudang as $g)
		<input @if(isset(old('id_gudang')[$g->id]) || in_array($g->id,$d->detail->pluck('id_gudang')->toArray())) checked="checked" @endif value="{{$g->id}}" id="id_gudang" data-id="{{'area_gudang'.$g->id}}" name="id_gudang[{{$g->id}}]" type="checkbox" class="minimal" >&nbsp;&nbsp;&nbsp;
		{{$g->nama}}
		&nbsp;&nbsp;&nbsp;
		@endforeach
	</div>
</div>

@foreach ($gudang as $g)

<div id="stok_gudang{{$g->id}}" @if(isset(old('id_gudang')[$g->id]) || in_array($g->id,$d->detail->pluck('id_gudang')->toArray())) @else style="display: none;" @endisset class="form-group">
	<label for="{{ 'stok_gudang_'.$g->id }}" class="col-lg-2 control-label">Stok Beras</label>
	<div class="col-sm-6">
		<input name="{{ 'stok_gudang_'.$g->id }}" type="number" class="form-control" id="{{ 'stok_gudang_'.$g->id }}" placeholder="Stok Beras Dari {{ $g->nama }}" readonly="readonly">
	</div>
</div>

<div id="area_gudang{{$g->id}}" @if(isset(old('id_gudang')[$g->id]) || in_array($g->id,$d->detail->pluck('id_gudang')->toArray())) @else style="display: none;" @endisset class="form-group {{ isset($errors) ? ($errors->has('isi_gudang_'.$g->id) ? 'has-error': '' ) : '' }}">
	<label for="{{ 'isi_gudang_'.$g->id }}" class="col-lg-2 control-label">{{ $g->nama }}</label>
	<div class="col-sm-6">
		<input value="{{old('isi_gudang_'.$g->id) ? old('isi_gudang_'.$g->id) : $d->detail->where('id_gudang',$g->id)->first()['jumlah']}}" name="{{ isset($name) ? $name : (isset($array) ? 'isi_gudang_'.$g->id.'[]' : 'isi_gudang_'.$g->id) }}" type="text" class="form-control" id="{{ 'isi_gudang_'.$g->id }}" placeholder="{{ $g->nama }}">
		@if($errors->has('isi_gudang_'.$g->id))<span class="help-block">{{$errors->first('isi_gudang_'.$g->id)}}</span>@endif
	</div>
</div>
@endforeach
@endsection

@include('import-icheck')
@include('import-datepicker')
@include('distribusi.script')

@push('script')
<script>
	$(document).ready(function(){


		// ambil stok beras berdasarkan jenis dari gudang
		var id_gudangs = {{$gudang->pluck('id')->toJson()}};

		function setStok(){
			var id_jenis_beras = $('#id_jenis_beras').val();

			for(idg of id_gudangs){
				$.get({
					url : '{{ url('api/gudang/stok-beras') }}?id_jenis_beras='+id_jenis_beras+'&id_gudang='+idg,
					success : function(response){
						if(typeof response == 'string')
							response = $.parseJSON(response);
						$yangDidistribusikan = $('#stok_gudang_'+response.data.id_gudang).parents('#stok_gudang'+response.data.id_gudang).next().find('input');
						$('#stok_gudang_'+response.data.id_gudang).val(response.data.jml_beras+Number($yangDidistribusikan.val()));
						$yangDidistribusikan.attr('max', response.data.jml_beras).attr('min',0);
					}
				});
			}
		}

		setStok();

		$('#id_jenis_beras').on('change', function(){
			setStok();
		});

	});
</script>
@endpush