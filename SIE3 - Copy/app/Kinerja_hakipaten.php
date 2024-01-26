<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kinerja_hakipaten extends Model
{
    protected $table = 'kinerja_hakipaten_author';
    public $timestamps = false;
   
    public function fakultas()
    {
        return $this->belongsTo('App\fakultas','ID_FAKULTAS');
    }
}
