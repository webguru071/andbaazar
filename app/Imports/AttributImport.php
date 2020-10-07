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
        $cat = explode('/',$row['category_slug']);
      
        $catId = Category::where('slug',$cat[1])->first();

        // dd($catId->id);
        
         if(!empty($row['type'])){
             $vals = explode(',',$row['type']);
            // dd($vals);
            // $attribute = [];
            foreach($vals as $val){
                $attribute = [
                    'label'          => $row['label'],
                    'suggestion'     => $row['suggestion'],
                    'type'           => $row['type'],
                    'required'       => $row['required'], 
                    'category_id'    => $catId ? $catId->id : 1,                  
                ];

                $attr = Attribute::create($attribute);

                if(!empty($row['type_value'])){
                    $vals = explode(',',$row['type_value']);
                    $option = [];
                    foreach($vals as $val){
                    $option[] = [
                        'values'  => $val,
                        'attribute_id'  => $attr->id,
                    ];
                    }
                    DB::table('attribute_metas')->insert($option);
                }

            } 
            // dd($attribute);
            
        }       
    }
}
