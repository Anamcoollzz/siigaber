<?php


Route::middleware('auth')->group(function(){
	
	Route::get('/','DasborController@index');

	Route::resource('akun', 'AkunController')->except('show');
	Route::resource('jenis-beras', 'JenisBerasController')->except('show');
	Route::resource('gudang', 'GudangController');
	Route::resource('mitra-kerja', 'MitraKerjaController')->except('show');
	Route::resource('pengadaan', 'PengadaanController');
	Route::put('/pengadaan/{pengadaan}/verifikasi','PengadaanController@verifikasi')->name('pengadaan.verifikasi');
	Route::put('/pengadaan/selesai/{pengadaan}','PengadaanController@selesai')->name('pengadaan.selesai');
	Route::resource('penggilingan', 'PenggilinganController');
	Route::put('/penggilingan/{penggilingan}/verifikasi','PenggilinganController@verifikasi')->name('penggilingan.verifikasi');
	Route::put('/penggilingan/{penggilingan}/selesai','PenggilinganController@selesai')->name('penggilingan.selesai');
	Route::resource('distribusi', 'DistribusiController');
	Route::put('/distribusi/{distribusi}/verifikasi','DistribusiController@verifikasi')->name('distribusi.verifikasi');
	Route::put('/distribusi/{distribusi}/selesai','DistribusiController@selesai')->name('distribusi.selesai');

	Route::get('/keluar', 'HomeController@keluar');

});

Auth::routes();