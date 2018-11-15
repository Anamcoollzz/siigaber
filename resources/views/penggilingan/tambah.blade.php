@extends('create-form')
@section('form')
@include('datepicker',['id'=>'tanggal_mulai','label'=>'Tanggal Mulai','value'=>date('Y-m-d')])
@include('input_number',['id'=>'biaya','label'=>'Biaya Penggilingan'])
@include('select',['id'=>'id_mitra_kerja','label'=>'Pilih Mitra Kerja','selectData'=>$listMitraKerja])
@include('select',['id'=>'id_jenis_beras','label'=>'Pilih Jenis Beras','selectData'=>$listJenisBeras])
@if(count($gudang) > 0)
<div class="col-md-10 col-md-offset-1" style="margin-bottom: 20px;">
	<h4>Pilih Gudang</h4>
	@foreach ($gudang as $g)
	<label>
		<input @isset(old('id_gudang')[$g->id]) checked="checked" @endisset value="{{$g->id}}" id="id_gudang" data-id="{{'area_gudang'.$g->id}}" name="id_gudang[{{$g->id}}]" type="checkbox" class="minimal" >&nbsp;&nbsp;&nbsp;
		{{$g->nama}}
	</label>
	&nbsp;&nbsp;&nbsp;
	@endforeach
</div>
@foreach ($gudang as $g)
<div id="area_gudang{{$g->id}}" @isset(old('id_gudang')[$g->id]) @else style="display: none;" @endisset class="form-group {{ isset($errors) ? ($errors->has('isi_gudang_'.$g->id) ? 'has-error': '' ) : '' }}">
	<label for="{{ 'isi_gudang_'.$g->id }}" class="col-lg-2 control-label">{{ $g->nama }}</label>
	<div class="col-sm-6">
		<input value="{{old('isi_gudang_'.$g->id)}}" name="{{ isset($name) ? $name : (isset($array) ? 'isi_gudang_'.$g->id.'[]' : 'isi_gudang_'.$g->id) }}" type="number" class="form-control" id="{{ 'isi_gudang_'.$g->id }}" placeholder="Jumlah Gabah Dari {{ $g->nama }}">
		@if($errors->has('isi_gudang_'.$g->id))<span class="help-block">{{$errors->first('isi_gudang_'.$g->id)}}</span>@endif
	</div>
</div>
@endforeach
@else
<div class="col-md-10 col-md-offset-2">
	<span class="label bg-red">Belum ada gudang</span>
</div>
@endif
@endsection

@include('import-icheck')
@include('import-datepicker')
@push('script')
<script>
	$(document).ready(function(){
		$('.minimal').on('ifChecked', function(){
			$('#'+$(this).data('id')).find('input').attr('required', true);
			$('#'+$(this).data('id')).fadeIn();
		});
		$('.minimal').on('ifUnchecked', function(){
			$('#'+$(this).data('id')).find('input').attr('required', false);
			$('#'+$(this).data('id')).fadeOut();
		});
		@foreach ($gudang as $g)
		$('#id_gudang{{$g->id}}').hide();
		@endforeach
	});
</script>
@endpush