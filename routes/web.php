<?php

Route::get('/',function()
{
	return redirect('akun');
});
Route::resource('akun', 'AkunController');
Route::resource('jenis-beras', 'JenisBerasController');
Route::resource('gudang', 'GudangController');
Route::resource('mitra-kerja', 'MitraKerjaController');