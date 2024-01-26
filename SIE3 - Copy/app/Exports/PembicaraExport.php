<?php

namespace App\Exports;

use App\Kinerja_pembicara;
use Maatwebsite\Excel\Concerns\FromCollection;

class PembicaraExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kinerja_pembicara::all();
    }
}
