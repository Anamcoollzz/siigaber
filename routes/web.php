<?php

Route::get('/',function()
{
	return redirect('akun');
});
Route::resource('akun', 'AkunController');
Route::resource('jenis-beras', 'JenisBerasController');