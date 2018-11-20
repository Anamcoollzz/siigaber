<div class="col-md-6">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Tujuan Distribusi</h3>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="form-group @if($errors->has('nama_desa')) has-error @endif">
					<label for="nama_desa" class="col-sm-4 control-label">Nama Desa</label>
					<div class="col-sm-6">
						<input required="required" name="nama_desa[]" type="text" class="form-control nama_desa" id="nama_desa" placeholder="Nama Desa" value="{{isset($index) ? old('nama_desa')[$index] : str_random(10)}}">
						@if($errors->has('nama_desa'))
						<span class="help-block">{{$errors->first('nama_desa')}}</span>
						@endif
					</div>
				</div>									
				<div class="form-group @if($errors->has('nama_kecamatan')) has-error @endif">
					<label for="nama_kecamatan" class="col-sm-4 control-label">Nama Kecamatan</label>
					<div class="col-sm-6">
						<input required="required" name="nama_kecamatan[]" type="text" class="form-control nama_kecamatan" id="nama_kecamatan" placeholder="Nama Kecamatan" value="{{isset($index) ? old('nama_kecamatan')[$index] : str_random(10)}}">
						@if($errors->has('nama_kecamatan'))
						<span class="help-block">{{$errors->first('nama_kecamatan')}}</span>
						@endif
					</div>
				</div>									
				<div class="form-group @if($errors->has('nama_kepala_desa')) has-error @endif">
					<label for="nama_kepala_desa" class="col-sm-4 control-label">Nama Kepala Desa</label>
					<div class="col-sm-6">
						<input required="required" name="nama_kepala_desa[]" type="text" class="form-control nama_kepala_desa" id="nama_kepala_desa" placeholder="Nama Kepala Desa" value="{{isset($index) ? old('nama_kepala_desa')[$index] : str_random(10)}}">
						@if($errors->has('nama_kepala_desa'))
						<span class="help-block">{{$errors->first('nama_kepala_desa')}}</span>
						@endif
					</div>
				</div>
				<div class="form-group @if($errors->has('kebutuhan')) has-error @endif">
					<label for="kebutuhan" class="col-sm-4 control-label">Kebutuhan</label>
					<div class="col-sm-6">
						<input required="required" name="kebutuhan[]" type="text" class="form-control kebutuhan" id="kebutuhan" placeholder="Kebutuhan (Kg)" value="{{isset($index) ? old('kebutuhan')[$index] : mt_rand(100,9999)}}">
						@if($errors->has('kebutuhan'))
						<span class="help-block">{{$errors->first('kebutuhan')}}</span>
						@endif
					</div>
				</div>
				<div class="form-group @if($errors->has('biaya')) has-error @endif">
					<label for="biaya" class="col-sm-4 control-label">Biaya Distribusi</label>
					<div class="col-sm-6">
						<input required="required" name="biaya[]" type="text" class="form-control biaya" id="biaya" placeholder="Biaya Distribusi (Rp)" value="{{isset($index) ? old('biaya')[$index] : mt_rand(100000,9999999)}}">
						@if($errors->has('biaya'))
						<span class="help-block">{{$errors->first('biaya')}}</span>
						@endif
					</div>
				</div>
				<div class="form-group @if($errors->has('jarak')) has-error @endif">
					<label for="jarak" class="col-sm-4 control-label">Jarak</label>
					<div class="col-sm-6">
						<input required="required" name="jarak[]" type="text" class="form-control jarak" id="jarak" placeholder="Jarak (Km)" value="{{isset($index) ? old('jarak')[$index] : mt_rand(1,999)}}">
						@if($errors->has('jarak'))
						<span class="help-block">{{$errors->first('jarak')}}</span>
						@endif
					</div>
				</div>
				<div class="form-group @if($errors->has('tanggal')) has-error @endif">
					<label for="tanggal" class="col-sm-4 control-label">Tanggal Distribusi</label>
					<div class="col-sm-6">
						<input required="required" name="tanggal[]" type="text" class="form-control tanggal" data-toggle="datepicker" id="tanggal" placeholder="Tanggal Distribusi" value="{{isset($index) ? old('tanggal')[$index] : date('Y-m-d',strtotime('+'.mt_rand(1,60).' days'))}}">
						@if($errors->has('tanggal'))
						<span class="help-block">{{$errors->first('tanggal')}}</span>
						@endif
					</div>
				</div>
			</div>
		</div>
		@isset($hapus)
		<div class="box-footer"><center><a class="btn btn-primary btn-flat" onclick="tambahDesa(event)">Tambah Desa</a><a class="btn btn-danger btn-flat" onclick="hapus(event, this)">Hapus</a></center></div>
		@endisset
	</div>
</div>