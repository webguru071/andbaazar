<?php

namespace App\Imports;

use App\Attribut;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Category;
use App\Models\Attribute;
// use App\Models\AttributeMeta;

class AttributImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //  dd($row);
        $cat = explode('/',$row['category_slug']);
        // dd($cat);
        
        // $attribute = [
        //     'label'          => $row['label_name_without_brand'],
        //     'suggestion'     => $row['suggession'],
        //     'type'           => $row['type'],
        //     'required'       => $row['required'],
        //     // 'search_sidebar' => $row['search_sidebar'],
        //     'category_id'    => $cat,
        // ];
        
        // $attri = Attribute::create($attribute);

       
            $vals = explode(',',$row['label_name_without_brand']);
            $attribute = [];
            foreach($vals as $val){
                $attribute[] = [
                    'label'          => $val,
                    'suggestion'     => $row['suggession'],
                    'type'           => $row['type'],
                    'required'       => $row['required'], 
                    'category_id'    => $cat->id,
                ];
            } 
            DB::table('attributes')->insert($attribute);
        
       
        // return new Attribut([
        //     //
        // ]);
    }
}
