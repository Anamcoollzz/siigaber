<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisBeras extends Model
{

	protected $table = 'jenis_beras';

	public $timestamps = false;

	protected $fillable = [
		'nama',
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
