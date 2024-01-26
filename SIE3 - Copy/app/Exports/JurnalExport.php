<?php

namespace App\Exports;

use App\Kinerja_jurnal;
use Maatwebsite\Excel\Concerns\FromCollection;

class JurnalExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kinerja_jurnal::all();
    }
}
