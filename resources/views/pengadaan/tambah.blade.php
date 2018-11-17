@extends('create-form')
@section('form')
@include('datepicker',['id'=>'tanggal','label'=>'Tanggal','value'=>date('Y-m-d')])
@include('input_number',['id'=>'jumlah','label'=>'Jumlah','required'=>true])
@include('input_number',['id'=>'biaya','label'=>'Biaya Pengadaan'])
@include('input_number',['id'=>'biaya_transport','label'=>'Biaya Transportasi'])
@include('select',['id'=>'jenis','label'=>'Jenis','selectData'=>[['text'=>'Beras','value'=>'Beras'],['text'=>'Gabah','value'=>'Gabah']]])
@include('select',['id'=>'id_mitra_kerja','label'=>'Pilih Mitra Kerja','selectData'=>$listMitraKerja])
@if(count($gudang) > 0)
<div class="form-group">
	<label for="" class="col-md-2 control-label">Pilih Gudang</label>
	<div class="col-md-10" style="margin-top: 4px;">
		@foreach ($gudang as $g)
		<label>
			<input @isset(old('id_gudang')[$g->id]) checked="checked" @endisset value="{{$g->id}}" id="id_gudang" data-id="{{'area_gudang'.$g->id}}" name="id_gudang[{{$g->id}}]" type="checkbox" class="minimal" >&nbsp;&nbsp;&nbsp;
			{{$g->nama}}
		</label>
		&nbsp;&nbsp;&nbsp;
		@endforeach
	</div>
</div>
@foreach ($gudang as $g)
<div id="area_gudang{{$g->id}}" @isset(old('id_gudang')[$g->id]) @else style="display: none;" @endisset class="form-group {{ isset($errors) ? ($errors->has('isi_gudang_'.$g->id) ? 'has-error': '' ) : '' }}">
	<label for="{{ 'isi_gudang_'.$g->id }}" class="col-lg-2 control-label">{{ $g->nama }}</label>
	<div class="col-sm-6">
		<input value="{{old('isi_gudang_'.$g->id)}}" name="{{ isset($name) ? $name : (isset($array) ? 'isi_gudang_'.$g->id.'[]' : 'isi_gudang_'.$g->id) }}" type="text" class="form-control" id="{{ 'isi_gudang_'.$g->id }}" placeholder="{{ $g->nama }}">
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