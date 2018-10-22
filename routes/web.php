<?php

Route::get('/',function(){
	return redirect('akun');
});

Route::middleware('auth')->group(function(){

	Route::resource('akun', 'AkunController')->except('show');
	Route::resource('jenis-beras', 'JenisBerasController')->except('show');
	Route::resource('gudang', 'GudangController')->except('show');
	Route::resource('mitra-kerja', 'MitraKerjaController')->except('show');
	Route::resource('pengadaan', 'PengadaanController');
	Route::put('/pengadaan/{pengadaan}/verifikasi','PengadaanController@verifikasi')->name('pengadaan.verifikasi');

});

Auth::routes();