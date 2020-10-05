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

        $catId = Category::where('slug',$cat)->first();

        // dd($catId->id);
        
        

        
         if(!empty($row['label'])){
             $vals = explode(',',$row['label']);
            // dd($vals);
            $attribute = [];
            foreach($vals as $val){
                $attribute[] = [
                    'label'          => $row['label'],
                    'suggestion'     => $row['suggestion'],
                    'type'           => $row['type'],
                    'required'       => $row['required'], 
                    'category_id'    => $catId ? $catId->id : 1,
                ];
            } 
            // dd($attribute);
            DB::table('attributes')->insert($attribute);
        }
           
        
       
        // return new Attribut([
        //     //
        // ]);
    }
}
