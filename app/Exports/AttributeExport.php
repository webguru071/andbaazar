<?php

namespace App\Exports;

use App\Models\Attribute;
use App\Models\AttributeMeta;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromArray;

class AttributeExport implements FromArray
// class AttributeExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Attribute::all();
    // }

    public function array(): array
    {
        $attributes = Attribute::with('attributeMeta')->get();
        // dd( $attributes);
        $data [] = ['id','label','suggestion','type','required'];

        foreach($attributes as $row){
            $data [] = [
                $row->id,
                // $row->attributeMeta->values,
                $row->label,
                $row->suggestion,
                $row->type,
                $row->required,
            ];
        }
        return $data;
    }
}
