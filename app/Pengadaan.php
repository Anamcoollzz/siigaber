<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
	protected $table = 'pengadaan';

	// public $timestamps = false;

	protected $fillable = [
		'tanggal_selesai',
		'tanggal',
		'biaya',
		'biaya_transport',
		'jenis_pengadaan',
		'id_mitra_kerja',
		'status',
		'id_jenis_beras',
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

	public function jenis()
	{
		return $this->belongsTo('App\JenisBeras', 'id_jenis_beras');
	}
}
