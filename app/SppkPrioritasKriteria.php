<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SppkPrioritasKriteria extends Model
{

	protected $table = 'sppk_prioritas_kriteria';

	public $timestamps = false;

	public function kriteria()
	{
		return $this->belongsTo('App\SppkKriteria', 'id_kriteria');
	}

	public function prioritassubkriteria()
	{
		return $this->hasMany('App\SppkPrioritasSubKriteria', 'id_prioritas_kriteria');
	}

	public function prioritaskategori()
	{
		return $this->belongsTo('App\SppkPrioritasKategori', 'id_prioritas_kategori');
	}

}
