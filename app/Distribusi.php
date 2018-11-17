<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distribusi extends Model
{
	protected $table = 'distribusi';

	protected $fillable = [
		'tanggal_mulai',
		'tanggal_selesai',
		'biaya_transport',
		'status',
		'id_mitra_kerja',
		'tipe',
		'nama_desa',
		'nama_kecamatan',
		'nama_kepala_desa',
		'id_jenis_beras',
	];

	public function mitrakerja()
	{
		return $this->belongsTo('App\MitraKerja','id_mitra_kerja');
	}

	public function detail()
	{
		return $this->hasMany('App\DistribusiDetail','id_distribusi');
	}

	public function jenis()
	{
		return $this->belongsTo('App\JenisBeras', 'id_jenis_beras');
	}
}
