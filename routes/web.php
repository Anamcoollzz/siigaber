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
	Route::resource('penggilingan', 'PenggilinganController');
	Route::put('/penggilingan/{penggilingan}/verifikasi','PenggilinganController@verifikasi')->name('penggilingan.verifikasi');
	Route::put('/penggilingan/{penggilingan}/selesai','PenggilinganController@selesai')->name('penggilingan.selesai');
	Route::resource('distribusi', 'DistribusiController');
	Route::put('/distribusi/{distribusi}/verifikasi','DistribusiController@verifikasi')->name('distribusi.verifikasi');

	Route::get('/keluar', 'HomeController@keluar');

});

Auth::routes();