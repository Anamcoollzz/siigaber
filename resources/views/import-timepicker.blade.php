@push('css')
<link rel="stylesheet" href="{{ asset('plugins/timepicker/bootstrap-timepicker.min.css') }}">
@endpush

@push('js')
<script src="{{ asset('plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
@endpush

@push('script')
<script>
	$(".timepicker").timepicker();
</script>
@endpush
