<?php

namespace App\Exports;

use App\Kinerja_hakipaten;
use Maatwebsite\Excel\Concerns\FromCollection;

class HakipatenExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kinerja_hakipaten::all();
    }
}
