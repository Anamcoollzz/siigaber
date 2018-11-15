<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penggilingan extends Model
{
	protected $table = 'penggilingan';

	protected $fillable = [
		'tanggal_mulai',
		'tanggal_selesai',
		'biaya',
		'biaya_transport',
		'status',
		'id_mitra_kerja',
		'id_jenis_beras',
	];

	public function mitrakerja()
	{
		return $this->belongsTo('App\MitraKerja','id_mitra_kerja');
	}

	public function detail()
	{
		return $this->hasMany('App\PenggilinganDetail','id_penggilingan');
	}

	public function jenis()
	{
		return $this->belongsTo('App\JenisBeras', 'id_jenis_beras');
	}
}
