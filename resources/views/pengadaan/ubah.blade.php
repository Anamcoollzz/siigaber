@extends('create-form')
@section('form')
@method('PUT')
@include('datepicker',['custom'=>[3,7],'id'=>'tanggal','label'=>'Tanggal','value'=>$d->tanggal])
@include('input_number',['custom'=>[3,7],'id'=>'biaya','label'=>'Biaya Pengadaan','required'=>true,'value'=>$d->biaya])
@include('select',['custom'=>[3,7],'id'=>'jenis','label'=>'Jenis Pengadaan','selectData'=>[['text'=>'Beras','value'=>'Beras'],['text'=>'Gabah','value'=>'Gabah']],'selected'=>$d->jenis_pengadaan])
@include('select',['custom'=>[3,7],'id'=>'id_mitra_kerja','label'=>'Pilih Mitra Kerja','selectData'=>$listMitraKerja,'selected'=>$d->id_mitra_kerja])
<div class="form-group">
	<label for="" class="col-md-3 control-label">Pilih Gudang</label>
	<div class="col-md-7" style="margin-top: 4px;">
		@foreach ($gudang as $g)
		<label>
			<input @if(isset(old('id_gudang')[$g->id]) || in_array($g->id,$d->kegudang->pluck('id_gudang')->toArray())) checked="checked" @endisset value="{{$g->id}}" id="id_gudang" data-id="{{'area_gudang'.$g->id}}" name="id_gudang[{{$g->id}}]" type="checkbox" class="minimal" >&nbsp;&nbsp;&nbsp;
			{{$g->nama}}
		</label>
		&nbsp;&nbsp;&nbsp;
		@endforeach
	</div>
</div>
@foreach ($gudang as $g)
<div id="area_gudang{{$g->id}}" @if(isset(old('id_gudang')[$g->id]) || in_array($g->id,$d->kegudang->pluck('id_gudang')->toArray())) @else style="display: none;" @endisset class="form-group {{ isset($errors) ? ($errors->has('isi_gudang_'.$g->id) ? 'has-error': '' ) : '' }}">
	<label for="{{ 'isi_gudang_'.$g->id }}" class="col-lg-3 control-label">{{ $g->nama }}</label>
	<div class="col-sm-7">
		<input value="{{old('isi_gudang_'.$g->id) ? old('isi_gudang_'.$g->id) : $d->kegudang->where('id_gudang',$g->id)->first()['jumlah']}}" name="{{ isset($name) ? $name : (isset($array) ? 'isi_gudang_'.$g->id.'[]' : 'isi_gudang_'.$g->id) }}" type="text" class="form-control" id="{{ 'isi_gudang_'.$g->id }}" placeholder="{{ $g->nama }}">
		@if($errors->has('isi_gudang_'.$g->id))<span class="help-block">{{$errors->first('isi_gudang_'.$g->id)}}</span>@endif
	</div>
</div>
@endforeach
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