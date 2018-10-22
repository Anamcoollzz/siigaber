<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
	protected $table = 'pengadaan';

	// public $timestamps = false;

	protected $fillable = [
		'tanggal',
		'jumlah',
		'biaya',
		'biaya_transport',
		'jenis_pengadaan',
		'id_mitra_kerja',
		'status',
	];

	public function masukgudang()
	{
		return $this->hasMany('App\PengadaanKeGudang', 'id_pengadaan');
	}

	public function mitrakerja()
	{
		return $this->belongsTo('App\MitraKerja', 'id_mitra_kerja');
	}

	public function kegudang()
	{
		return $this->hasMany('App\PengadaanKeGudang', 'id_pengadaan');
	}
}
