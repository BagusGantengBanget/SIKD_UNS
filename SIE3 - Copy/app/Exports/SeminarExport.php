<?php

namespace App\Exports;

use App\Kinerja_seminar;
use Maatwebsite\Excel\Concerns\FromCollection;

class SeminarExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kinerja_seminar::all();
    }
}
