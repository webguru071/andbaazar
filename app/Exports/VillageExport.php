<?php

namespace App\Exports;

use App\Models\Village;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromArray;

// class VillageExport implements FromCollection

class VillageExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {

        $village = Village::all();
        // dd( $attributes);
        $data [] = ['id','union_id','bn_name','union_lat','union_lng'];

        foreach($village as $row){
            $data [] = [
                $row->id,
                // $row->attributeMeta->values,
                $row->union_id,
                $row->bn_name,
                $row->lat,
                $row->lng,
            ];
        }
        return $data;
        // return Village::all();
    }
}
