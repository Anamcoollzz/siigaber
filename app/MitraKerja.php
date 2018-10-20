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

	public function scopeListMode($q)
	{
		$data = [];
		foreach ($q->get() as $d) {
			$data[] = [
				'text'=>$d->nama,
				'value'=>$d->id,
			];
		}
		return $data;
	}
}
