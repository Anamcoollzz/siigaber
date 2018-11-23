<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SppkPrioritasSubKriteria extends Model
{
    protected $table = 'sppk_prioritas_sub_kriteria';

	public $timestamps = false;

	public function prioritaskriteria()
	{
		return $this->belongsTo('App\SppkPrioritasKriteria', 'id_prioritas_kriteria');
	}
}
