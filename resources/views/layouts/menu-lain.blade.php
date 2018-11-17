
<li @if(in_array($active, ['akun.index'])) class="active" @endif>
	<a href="{{ route('akun.index') }}">
		<i class="fa fa-users"></i> 
		Akun
	</a>
</li>

<li @if(in_array($active, ['jenis-beras.index'])) class="active" @endif>
	<a href="{{ route('jenis-beras.index') }}">
		<i class="fa fa-cubes"></i> 
		Jenis Beras
	</a>
</li>

<li @if(in_array($active, ['gudang.index'])) class="active" @endif>
	<a href="{{ route('gudang.index') }}">
		<i class="fa fa-university"></i> 
		Gudang
	</a>
</li>

<li @if(in_array($active, ['mitra-kerja.index'])) class="active" @endif>
	<a href="{{ route('mitra-kerja.index') }}">
		<i class="fa fa-user-plus"></i>
		Mitra Kerja
	</a> 
</li>

<li @if(in_array($active, ['pengadaan.index'])) class="active" @endif>
	<a href="{{ route('pengadaan.index') }}">
		<i class="fa fa-flash"></i> 
		Pengadaan
		@include('layouts.label',['label'=>[$a1,$a2]])
	</a>
</li>

<li @if(in_array($active, ['penggilingan.index'])) class="active" @endif>
	<a href="{{ route('penggilingan.index') }}">
		<i class="fa fa-cart-arrow-down"></i>
		Penggilingan
		@include('layouts.label',['label'=>[$b1,$b2]])
	</a>
</li>

<li @if(in_array($active, ['distribusi.index'])) class="active" @endif>
	<a href="{{ route('distribusi.index') }}">
		<i class="fa fa-rocket"></i>
		Distribusi
		@include('layouts.label',['label'=>[$c1,$c2]])
	</a>
</li>