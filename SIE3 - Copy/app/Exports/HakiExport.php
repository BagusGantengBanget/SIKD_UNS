<?php

namespace App\Exports;

use App\Kinerja_haki;
use Maatwebsite\Excel\Concerns\FromCollection;

class HakiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kinerja_haki::all();
    }
}
