<?php

namespace App\Exports;

use App\Kinerja_buku;
use Maatwebsite\Excel\Concerns\FromCollection;

class BukuExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kinerja_buku::all();
    }
}
