<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GudangDetail extends Model
{
	protected $table = 'detail_gudang';

	public $timestamps = false;

	protected $fillable = [
		'id_gudang',
		'id_jenis_beras',
		'jml_gabah',
		'jml_beras',
	];
}
