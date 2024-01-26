<?php

namespace App\Exports;

use App\Kinerja_program;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProgramExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kinerja_program::all();
    }
}
