<?php

Route::get('/',function()
{
	return redirect('akun');
});
Route::resource('akun', 'AkunController')->except('show','destroy');
Route::resource('jenis-beras', 'JenisBerasController')->except('show','destroy');
Route::resource('gudang', 'GudangController')->except('show','destroy');
Route::resource('mitra-kerja', 'MitraKerjaController')->except('show','destroy');
Route::resource('pengadaan', 'PengadaanController')->except('show','destroy');