@extends('app.form')
@section('content')
<div class="content-wrapper">
	@include('page_header2')
	<section class="content">
		<form action="{{ route('sppk.prioritas-sub-store',[$d->id]) }}" method="post" class="form-horizontal">
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
							@foreach ($d->prioritaskategori as $kategori)
							<h4 class="text-center">{{$kategori->nama}}</h4>
							<hr>
							@foreach ($kategori->prioritaskriteria as $kriteria)
							{{$kriteria->nama}}
							<ul class="example">
								@foreach ($kriteria->kriteria->subkriteria as $sub)
								<li style="cursor: move;">
									{{$sub->nama}}
									<input type="hidden" name="prioritas[{{$kategori->id}}][{{$kriteria->id}}][]" type="text" value="{{$sub->id}}">
								</li>
								@endforeach
							</ul>
							@endforeach
							@endforeach
							<div class="alert alert-info">
								Drag dan drop pada titik di kiri
							</div>
						</div>
					</div>
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

@push('js')
<script src="{{ asset('js/jquery-sortable.js') }}"></script>
@endpush

@push('script')
<script>
	$(function  () {
		$("ul.example").sortable();
	});
</script>
@endpush

@push('style')
<style>
body.dragging, body.dragging * {
	cursor: move !important;
}

.dragged {
	position: absolute;
	opacity: 0.5;
	z-index: 2000;
}

ol.example li.placeholder {
	position: relative;
	cursor: move;
}
ol.example li.placeholder:before {
	position: absolute;
	cursor: move;
}
</style>
@endpush