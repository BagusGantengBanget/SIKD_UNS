<?php

namespace App\Exports;

use App\Kinerja_varietas;
use Maatwebsite\Excel\Concerns\FromCollection;

class VarietasExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kinerja_varietas::all();
    }
}
