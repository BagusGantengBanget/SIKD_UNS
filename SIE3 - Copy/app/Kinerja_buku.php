<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kinerja_buku extends Model
{
    protected $table = 'kinerja_buku_author';
    protected $primaryKey = 'id_author';
    public $timestamps = false;
}

