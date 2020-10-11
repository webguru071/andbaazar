<?php

namespace App\Exports;

use App\Village;
use Maatwebsite\Excel\Concerns\FromCollection;

class VillageExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Village::all();
    }
}
