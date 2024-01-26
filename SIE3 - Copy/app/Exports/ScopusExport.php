<?php

namespace App\Exports;

use App\Kinerja_scopus;
use Maatwebsite\Excel\Concerns\FromCollection;

class ScopusExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kinerja_scopus::all();
    }
}
