<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SppkKategori extends Model
{
    protected $table = 'sppk_kategori';

    public $timestamps = false;

    public function kriteria()
    {
    	return $this->hasMany('App\SppkKriteria', 'id_kategori');
    }
}
