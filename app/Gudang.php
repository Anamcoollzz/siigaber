<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{

	protected $table = 'gudang';

	public $timestamps = false;

	protected $fillable = [
		'nama',
		'lokasi',
		'kapasitas',
	];

	public function detail()
	{
		return $this->hasMany('App\GudangDetail', 'id_gudang');
	}

}
