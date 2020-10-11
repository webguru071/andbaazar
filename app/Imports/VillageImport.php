<?php

namespace App\Imports;

// use App\Village;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Union;
use App\Models\Village;


class VillageImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $uni = explode('/',$row['union_slug']);

    //   dd( $uni);

        $uniId = Union::where('slug', $uni)->first();

            //   dd( $uniId);

        if(!empty($row['lat'])){
            $vals = explode(',',$row['lat']);         
           // dd($vals);         
           foreach($vals as $val){
               $village = [
                //    'bn_name'           => $row['bn_name'],
                   'lat'               => $row['lat'],
                   'lng'               => $row['lng'],              
                   'union_id'          => $uniId ? $uniId->id : 1,                  
               ];

            //    DB::table('villages')->insert($village);
               $vill = Village::create($village);

               if(!empty($row['bn_name'])){
                $vals = explode(',',$row['bn_name']);
                $option = [];
                foreach($vals as $val){
                $option[] = [
                    'bn_name'           => $val,   
                    'union_id'          => $uniId ? $uniId->id : 1,                 
                ];
                }
                DB::table('villages')->insert($option);
            }
         }
      }
   }
}


