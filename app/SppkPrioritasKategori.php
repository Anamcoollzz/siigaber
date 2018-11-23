<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SppkPrioritasKategori extends Model
{
    protected $table = 'sppk_prioritas_kategori';

    public $timestamps = false;

    public function prioritaskriteria()
    {
    	return $this->hasMany('App\SppkPrioritasKriteria', 'id_prioritas_kategori');
    }
}
