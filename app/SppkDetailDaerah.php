<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SppkDetailDaerah extends Model
{
    protected $table = 'sppk_detail_daerah';
    public $timestamps = false;

    public function prioritassubkriteria()
    {
    	return $this->belongsTo('App\SppkPrioritasSubKriteria', 'id_prioritas_sub_kriteria');
    }
}
