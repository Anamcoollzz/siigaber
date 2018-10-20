@extends('create-form')
@section('form')
@include('input',['id'=>'tanggal','label'=>'Tanggal','value'=>date('Y-m-d'),'readonly'=>true])
@include('input_number',['id'=>'jumlah','label'=>'Jumlah'])
@include('input_number',['id'=>'biaya','label'=>'Biaya Pengadaan'])
@include('input_number',['id'=>'biaya_transport','label'=>'Biaya Transportasi'])
@include('select',['id'=>'jenis','label'=>'Jenis','selectData'=>[['text'=>'Beras','value'=>'Beras'],['text'=>'Gabah','value'=>'Gabah']]])
@include('select',['id'=>'id_mitra_kerja','label'=>'Pilih Mitra Kerja','selectData'=>$listMitraKerja])
<div class="col-md-10 col-md-offset-1" style="margin-bottom: 20px;">
	<h4>Pilih Gudang</h4>
	@foreach ($gudang as $g)
	<label>
		<input value="{{$g->id}}" id="id_gudang" data-id="{{'id_gudang'.$g->id}}" name="id_gudang[]" type="checkbox" class="minimal" >&nbsp;&nbsp;&nbsp;
		{{$g->nama}}
	</label>
	&nbsp;&nbsp;&nbsp;
	@endforeach
</div>
@if(count($errors->all()) > 0)
@foreach (old('isi_gudang') as $g)
<div id="id_gudang{{$g}}">
@include('input',['id'=>'isi_gudang','array'=>true,'label'=>'Isi '.$gudang[$loop->index]->nama,'index'=>$loop->index])&nbsp;&nbsp;&nbsp;
</div>
@endforeach
@else
@foreach ($gudang as $g)
<div id="id_gudang{{$g->id}}">
	@include('input',['id'=>'isi_gudang','array'=>true,'label'=>'Isi '.$g->nama])&nbsp;&nbsp;&nbsp;
</div>
@endforeach
@endif
@endsection

@include('import-icheck')
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