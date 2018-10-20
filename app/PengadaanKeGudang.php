<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengadaanKeGudang extends Model
{
	protected $table = 'pengadaan_ke_gudang';

	public $timestamps = false;

	protected $fillable = [
		'id_gudang',
		'jumlah',
	];

	public function pengadaan()
	{
		return $this->hasMany('App\Pengadaan', 'id_pengadaan');
	}
}
