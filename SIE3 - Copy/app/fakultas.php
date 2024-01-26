<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fakultas extends Model
{
    public $table = 'ref_unit_fakultas';
    public $timestamps = false;
    public $primarykey = 'ID_FAKULTAS';
    /* public function kinerja_buku()
    {
        return $this->hasMany('App\Kinerja_buku');
    } */
    
    /* protected $fillable = [
        'nama',
    ]; */

    public function hakipaten()
    {
        return $this->hasMany('App\Kinerja_hakipaten','id_author');
    }
}