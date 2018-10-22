@push('css')
<link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
@endpush

@push('js')
<script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
@endpush

@push('script')
<script>
	$('[data-toggle="datepicker"]').datepicker({
		autoclose: true,
		format : "yyyy-mm-dd"
	});
</script>
@endpush
