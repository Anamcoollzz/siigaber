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

}
