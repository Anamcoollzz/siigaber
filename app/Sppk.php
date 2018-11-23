<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sppk extends Model
{
    
    protected $table = 'sppk';

    protected $fillable = [
    	'teratas',
    	'id_teratas',
    	'hasil',
    ];

    protected $casts = [
    	'hasil'=>'array',
    ];

    public function prioritaskategori()
    {
    	return $this->hasMany('App\SppkPrioritasKategori','id_sppk');
    }

    public function daerahtujuan()
    {
    	return $this->hasMany('App\SppkDaerahTujuan', 'id_sppk');
    }

    public function detailteratas()
    {
    	return $this->belongsTo('App\SppkDaerahTujuan', 'id_teratas');
    }

}
