@extends('app.form')
@section('content')
<div class="content-wrapper">
	@include('page_header2')
	<section class="content">
		<form action="{{ route('sppk.store') }}" method="post" class="form-horizontal">
			@csrf
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

						<div class="box-body">
							<div class="row">
								<div class="form-group @if($errors->has('keterangan')) has-error @endif">
									<label for="keterangan" class="col-sm-3 control-label">Keterangan</label>
									<div class="col-sm-6">
										<textarea name="keterangan" type="text" class="form-control" id="keterangan" placeholder="Keterangan Tujuan Penggunaan SPPK">{{old('keterangan')}}</textarea>
										@if($errors->has('keterangan'))<span class="help-block">{{$errors->first('keterangan')}}</span>@endif
									</div>
								</div>
							</div>
						</div>
						<div class="box-footer">
							@include('batal_btn')
							<a href="" onclick="tambahDesa(event)" class="btn btn-flat btn-primary">Tambah Desa</a>
						</div>
					</div>
				</div>
				<div id="template-desa">
					@if(count($errors->all()) > 0)
					@include('sppk.tujuan-distribusi',['index'=>0])
					@else
					@include('sppk.tujuan-distribusi')
					@endif
				</div>
				<div id="desa-tambahan">
					@if(count($errors->all()) > 0)
					@if(count(old('nama_desa')) > 1)
					@foreach (range(1,count(old('nama_desa')) - 1) as $old)
					@include('sppk.tujuan-distribusi',['index'=>$old,'hapus'=>true])
					@endforeach
					@endif
					@endif
				</div>
				<div class="col-md-12">
					<div class="box">
						<div class="box-body">
							<center>
								<button class="btn btn-primary btn-flat" type="submit">Selanjutnya</button>
								<button class="btn btn-success btn-flat" onclick="random(event)">Random</button>
							</center>
						</div>
					</div>
				</div>
			</div>
		</form>
	</section>
</div>
@endsection

@push('script')
<script>
	function tambahDesa(e){
		e.preventDefault();
		var template = $('#template-desa').html();
		template = $(template).find('.box-body').after('<div class="box-footer"><center><a class="btn btn-primary btn-flat" onclick="tambahDesa(event)">Tambah Desa</a><a class="btn btn-danger btn-flat" onclick="hapus(event, this)">Hapus</a></center></div>').parents('.col-md-6');
		$('#desa-tambahan').append(template);
		$('[data-toggle="datepicker"]').datepicker({
			autoclose: true,
			format : "yyyy-mm-dd"
		});
	}

	function hapus(e, el){
		e.preventDefault();
		$(el).parents('.col-md-6').remove();
	}

	function randomDate(start, end) {
		var d = new Date(start.getTime() + Math.random() * (end.getTime() - start.getTime()))
		return d.getFullYear()+'-'+(d.getMonth()+1)+'-'+d.getDate();
	}

	function makeid() {
		var text = "";
		var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

		for (var i = 0; i < 5; i++)
			text += possible.charAt(Math.floor(Math.random() * possible.length));

		return text;
	}

	function random(e){
		e.preventDefault();
		$('.nama_desa').each(function(item){
			$(this).val(makeid());
		});
		$('.nama_kecamatan').each(function(item){
			$(this).val(makeid());
		});
		$('.nama_kepala_desa').each(function(item){
			$(this).val(makeid());
		});
		$('.kebutuhan').each(function(item){
			$(this).val(Math.floor(Math.random() * 100));
		});
		$('.biaya').each(function(item){
			$(this).val(Math.floor(Math.random() * 999));
		});
		$('.jarak').each(function(item){
			$(this).val(Math.floor(Math.random() * 50));
		});
		$('.tanggal').each(function(item){
			$(this).val(randomDate(new Date(), new Date('2018-11-12')));
		});
	}

</script>
@endpush

@include('import-datepicker')

@php
Session::forget('nama_desa');
@endphp