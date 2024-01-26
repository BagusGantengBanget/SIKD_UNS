<?php

namespace App\Exports;

use App\Kinerja_karyaseni;
use Maatwebsite\Excel\Concerns\FromCollection;

class KaryaseniExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kinerja_karyaseni::all();
    }
}
