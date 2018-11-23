<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SppkKriteria extends Model
{
    protected $table = 'sppk_kriteria';

    public $timestamps = false;

    public function subkriteria()
    {
    	return $this->hasMany('App\SppkSubKriteria', 'id_kriteria');
    }
}
