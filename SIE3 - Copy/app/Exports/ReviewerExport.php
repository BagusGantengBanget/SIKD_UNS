<?php

namespace App\Exports;

use App\Kinerja_reviewer;
use Maatwebsite\Excel\Concerns\FromCollection;

class ReviewerExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Kinerja_reviewer::all();
    }
}
