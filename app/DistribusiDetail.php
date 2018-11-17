<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DistribusiDetail extends Model
{
	protected $table = 'detail_distribusi';

	public $timestamps = false;

	protected $fillable = [
		'id_distribusi',
		'id_gudang',
		'jumlah',
	];

	public function gudang()
	{
		return $this->belongsTo('App\Gudang', 'id_gudang');
	}
}
