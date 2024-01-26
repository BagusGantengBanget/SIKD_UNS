<?php

namespace App\Exports;

use App\Kinerja_koran;
use Maatwebsite\Excel\Concerns\FromCollection;

class KoranExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kinerja_koran::all();
    }
}
