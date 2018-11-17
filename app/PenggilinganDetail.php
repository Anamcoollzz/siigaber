<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenggilinganDetail extends Model
{
	protected $table = 'detail_penggilingan';

	protected $fillable = [
		'id_penggilingan',
		'id_gudang',
		'jumlah',
	];

	public $timestamps = false;

	public function gudang()
	{
		return $this->belongsTo('App\Gudang', 'id_gudang');
	}
}
