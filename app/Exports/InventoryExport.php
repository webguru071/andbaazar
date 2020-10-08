<?php

namespace App\Exports;

use App\Models\InventoryAttribute;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromArray;

class InventoryExport implements FromArray

// class InventoryExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
    //     return Inventory::all();
    // }


    public function array(): array
    {
        $inventories = InventoryAttribute::with('options')->get();
        // dd( $attributes);
        $data [] = ['id','name'];

        foreach($inventories as $row){
            $data [] = [
                $row->id,
                $row->name,
                // $row->options->option,              
            ];
        }
        return $data;
    }
}
