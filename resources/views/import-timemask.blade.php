@push('js')
<script src="{{ asset('plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
<script src="{{ asset('plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
@endpush

@push('script')
<script>
	$("[data-mask]").inputmask('hh:mm:ss',{placeholder:'hh:mm:ss'});
</script>
@endpush
