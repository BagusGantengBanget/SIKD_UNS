<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class data_dosen extends Model
{
    public $table = 'dosen';
    public $timestamps = false;
    /* public function kinerja_buku()
    {
        return $this->hasMany('App\Kinerja_buku');
    } */
    
    /* protected $fillable = [
        'nama',
    ]; */
}