<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GudangDetail extends Model
{
	protected $table = 'detail_distribusi';

	public $timestamps = false;

	protected $fillable = [
		'id_distribusi',
		'id_gudang',
		'jumlah',
	];
}
