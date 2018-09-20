@push('css')
<link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
@endpush

@push('js')
<script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
@endpush

@push('script')
<script>
	$(document).ready(function(){
		$(".select2").select2();
	});
</script>
@endpush
