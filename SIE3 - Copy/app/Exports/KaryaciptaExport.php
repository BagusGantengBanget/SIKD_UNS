<?php

namespace App\Exports;

use App\Kinerja_karyacipta;
use Maatwebsite\Excel\Concerns\FromCollection;

class KaryaciptaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kinerja_karyacipta::all();
    }
}
