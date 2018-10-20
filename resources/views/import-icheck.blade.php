@push('css')
<link rel="stylesheet" href="{{asset('plugins/iCheck/all.css')}}">
@endpush
@push('js')
<script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
@endpush
@push('script')
<script>
	$(document).ready(function(){
		//iCheck for checkbox and radio inputs
		$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			checkboxClass: 'icheckbox_minimal-blue',
			radioClass: 'iradio_minimal-blue'
		});
    // //Red color scheme for iCheck
    // $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
    // 	checkboxClass: 'icheckbox_minimal-red',
    // 	radioClass: 'iradio_minimal-red'
    // });
    // //Flat red color scheme for iCheck
    // $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    // 	checkboxClass: 'icheckbox_flat-green',
    // 	radioClass: 'iradio_flat-green'
    // });
});
</script>
@endpush