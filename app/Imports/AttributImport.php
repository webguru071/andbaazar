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


// dd($row);
//      $cat = explode('/',$row['category_slug']); 
//         return new Attribute([
//             'label'     => $row['label_name'],
//             'type'    => $row['type'],
//             'required'    => $row['required'],
//             'suggestion'    => $row['suggestion'],   
//             'category_id'   =>2,
            
        //       foreach($value as $row)
        //       {
        //        $insert_data[] = array(
        //         'label'=> $row['label_name_without_brand'],
        //         'type'   => $row['type'],
        //         'required'   => $row['required'],
        //         'suggession'    => $row['suggession'],               
        //        );
        //       }
        //      }
       
        //      if(!empty($insert_data))
        //      {
        //       DB::table('attributes')->insert($insert_data);
        //      }
        //     }
        //     return back()->with('success', 'Excel Data Imported successfully.');
        //    }

        
        // //  dd($row);
        // $cat = explode('/',$row['category_slug']);
        // // dd($cat);
        
        // // $attribute = [
        // //     'label'          => $row['label_name_without_brand'],
        // //     'suggestion'     => $row['suggession'],
        // //     'type'           => $row['type'],
        // //     'required'       => $row['required'],
        // //     // 'search_sidebar' => $row['search_sidebar'],
        // //     'category_id'    => $cat,
        // // ];
        
        // // $attri = Attribute::create($attribute);

       
        //     $vals = explode(',',$row['label_name_without_brand']);
        //     $attribute = [];
        //     foreach($vals as $val){
        //         $attribute[] = [
        //             'label'          => $val,
        //             'suggestion'     => $row['suggession'],
        //             'type'           => $row['type'],
        //             'required'       => $row['required'], 
        //             'category_id'    => $cat->id,
        //         ];
        //     } 
        //     DB::table('attributes')->insert($attribute);

        //  dd($row);
        $cat = explode('/',$row['category_slug']);

        // $catId = Category::where('slug',$cat)->first();
        
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
                    // 'category_id'    => $cat->id,
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

            


            // I am not happy

            // what is happend? come here..
        //  $attr = DB::table('attributes')->create($attribute);
        //  dd($attr);

       
        }     

        // $attId = Attribute::all();
        //  dd($attId);

        // $attId = Attribute::where('id',$attr[1])->first();
        // dd($attId);

        



    //   if(!empty($row['type_value'])){
    //     $vals = explode(',',$row['type_value']);
    //     $option = [];
    //     foreach($vals as $val){
    //       $option[] = [
    //         'values'  => $val,

    //         // 'inventory_attribute_id'  => $attr->id,
    //         'attribute_id'    => $attId ? $attId->id : 1,
    //         // 'attribute_id'  => $attr->id,
    //       ];
    //     }
    //     DB::table('attribute_metas')->insert($option);
    //   }
           

        
       
        // // return new Attribut([
        // //     //
        }
}
