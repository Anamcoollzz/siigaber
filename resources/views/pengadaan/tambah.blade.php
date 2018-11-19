@extends('app.form')
@section('content')
<div class="content-wrapper">
	@include('page_header2')
	<section class="content">
		<div class="row">
			@include('success_msg')
			<div class="col-md-12">
				@if (session('error_msg'))
				<div class="alert alert-danger">  
					{{session('error_msg')}}
				</div>
				@endif
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">{{ $title }}</h3>
					</div>
					<form action="{{ $action }}" method="post" class="form-horizontal" enctype="multipart/form-data">
						@csrf
						<div class="box-body">
							@include('datepicker',['id'=>'tanggal','label'=>'Tanggal','value'=>date('Y-m-d'),'custom'=>[3,7],'required'=>true,])
							{{-- @include('input_number',['id'=>'jumlah','label'=>'Jumlah','required'=>true,'custom'=>[3,7]]) --}}
							@include('input_number',['id'=>'biaya','label'=>'Biaya Pengadaan','custom'=>[3,7],'min'=>1,'required'=>true,])
							{{-- @include('input_number',['id'=>'biaya_transport','label'=>'Biaya Transportasi','custom'=>[3,7]]) --}}
							@include('select',['id'=>'jenis','label'=>'Jenis Pengadaan','selectData'=>[['text'=>'Beras','value'=>'Beras'],['text'=>'Gabah','value'=>'Gabah']],'custom'=>[3,7]])
							@include('select',['id'=>'id_jenis_beras','label'=>'Jenis Beras','selectData'=>$listJenisBeras,'custom'=>[3,7]])
							@include('select',['id'=>'id_mitra_kerja','label'=>'Pilih Mitra Kerja','selectData'=>$listMitraKerja,'custom'=>[3,7]])
							@if(count($gudang) > 0)
							<div class="form-group">
								<label for="" class="col-md-3 control-label">Pilih Gudang</label>
								<div class="col-md-9" style="margin-top: 4px;">
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
								<label for="{{ 'isi_gudang_'.$g->id }}" class="col-lg-3 control-label">{{ $g->nama }}</label>
								<div class="col-sm-7">
									<input value="{{old('isi_gudang_'.$g->id)}}" name="{{ isset($name) ? $name : (isset($array) ? 'isi_gudang_'.$g->id.'[]' : 'isi_gudang_'.$g->id) }}" type="text" class="form-control" id="{{ 'isi_gudang_'.$g->id }}" placeholder="Jumlah yang masuk ke {{ $g->nama }}">
									@if($errors->has('isi_gudang_'.$g->id))<span class="help-block">{{$errors->first('isi_gudang_'.$g->id)}}</span>@endif
								</div>
							</div>
							@endforeach
							@else
							<div class="col-md-10 col-md-offset-2">
								<span class="label bg-red">Belum ada gudang</span>
							</div>
							@endif
						</div>
						<div class="box-footer">
							@include('batal_btn')
							@isset($saveBtn)
							@else
							@include('simpan_btn')
							@endisset
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-4">
				
			</div>
		</div>
	</section>
</div>
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