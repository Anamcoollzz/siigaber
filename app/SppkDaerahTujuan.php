<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SppkDaerahTujuan extends Model
{

    protected $table = 'sppk_daerah_tujuan';

    public $timestamps = false;

    protected $appends = [
    	'tenggang_waktu',
    ];

    public function getTenggangWaktuAttribute()
    {
    	return floor((strtotime($this->tanggal_distribusi) - strtotime(date('Y-m-d'))) / 3600 / 24);
    }

    public function detail()
    {
    	return $this->hasMany('App\SppkDetailDaerah', 'id_daerah_tujuan');
    }

}
