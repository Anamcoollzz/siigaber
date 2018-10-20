<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MitraKerja extends Model
{
	protected $table = 'mitra_kerja';

	public $timestamps = false;

	protected $fillable = [
		'nama', 
		'bidang',
		'kontak',
		'deskripsi',
		'alamat',
	];
}
