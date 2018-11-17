@push('script')
<script>
	$(document).ready(function(){
		$('[type="checkbox"]').on('ifChecked', function(){
			var id_gudang = $(this).data('id').toString().replace('area_gudang','');
			$('#'+$(this).data('id')).find('input').attr('required', true);
			$('#'+$(this).data('id')).fadeIn();
			$('#stok_gudang'+id_gudang).fadeIn();
		});
		// $('[type="checkbox"]').trigger('ifChecked');
		$('[type="checkbox"]').on('ifUnchecked', function(){
			var id_gudang = $(this).data('id').toString().replace('area_gudang','');
			$('#'+$(this).data('id')).find('input').attr('required', false);
			$('#'+$(this).data('id')).fadeOut();
			$('#stok_gudang'+id_gudang).fadeOut();
		});

		$('#tipe-umum').on('ifChecked', function(){
			$('#mitra-kerja-area').fadeIn();
			$('#raskin-area').fadeOut();
			$('#nama_desa').attr('required',false);
			$('#nama_kecamatan').attr('required',false);
			$('#nama_kepala_desa').attr('required',false);
		});
		// $('#tipe-umum').trigger('ifChecked');

		$('#tipe-raskin').on('ifChecked', function(){
			$('#mitra-kerja-area').fadeOut();
			$('#raskin-area').fadeIn();
			$('#nama_desa').attr('required',true);
			$('#nama_kecamatan').attr('required',true);
			$('#nama_kepala_desa').attr('required',true);
		});
		// $('#tipe-raskin').trigger('ifChecked');

		@foreach ($gudang as $g)
		$('#id_gudang{{$g->id}}').hide();
		@endforeach

	});
</script>
@endpush