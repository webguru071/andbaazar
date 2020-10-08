<?php

namespace App\Imports;

use App\Models\InventoryAttribute;
use App\Models\InventoryAttributeOption;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\ToModel;

class InventoryImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      // dd($row);
      $cat = explode('/',$row['category_slug']);
      // dd($cat[1]);
      $catId = Category::where('slug',$cat[1])->first();

      // $catId = Category::where('slug',$cat[1])->first()->id;

      $inAttr = [
        'name'  => $row['inventory_name'],
        'description' =>'descas asdf asdf',
      ];
      $attr = InventoryAttribute::create($inAttr);

      if(empty($row['name'])){
        $relation = [
              // 'category_id' => $cat[1],
              'category_id'    => $catId ? $catId->id : 1,  
              'inventory_attribute_id'  => $attr->id,
            ];
          DB::table('inventory_attribute_category')->insert($relation);
          }  

          if(!empty($row['inventory_value'])){
            $vals = explode(',',$row['inventory_value']);
            $option = [];
            foreach($vals as $val){
            $value[] = [
                'option'  => $val,
                'inventory_attribute_id'  => $attr->id,
            ];
            }
            DB::table('inventory_attribute_options')->insert($value);
        }

      if(!empty($row['category_id'])){
        $vals = explode(',',$row['category_id']);
        $relation = [];
        foreach($vals as $val){
          $relation []= [
            'category_id' => $cat->id,
            'inventory_attribute_id'  => $attr->id,
          ];
        }
         dd($relation[1]);
        DB::table('inventory_attribute_category')->insert($relation);
      }    
    }
}
