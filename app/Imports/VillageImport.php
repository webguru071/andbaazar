<?php

namespace App\Imports;

// use App\Village;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Union;
use App\Models\Village;
use Baazar;

class VillageImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // $uni = explode('/',$row['union_slug']);

    //   dd( $uni);
        
        $uniId = Union::where('slug', $row['union_slug'])->first();
        if($uniId){

            if(!empty($row['lat'])){
                if(empty($uniId->lat)){
                    // DB::enableQueryLog();
                    // dd(DB::getQueryLog());
                    $uniId->lat = $row['lat'];
                    $uniId->lng = $row['lng'];
                    $uniId->save();
                }
            }

            if(!empty($row['bn_name'])){
                $options = [];
                $vals = explode(',',rtrim($row['bn_name'],','));
                $villageModel = new Village;
                foreach($vals as $val){
                    $name = Baazar::getUniqueSlug($villageModel,$val);
                    $options[] = [
                        'name'   => ucfirst($name),
                        'bn_name'   => $val,
                        'union_id'  =>$uniId->id,
                        'slug'      => $name,
                        'created_at'=> now(),
                    ];
                }
                DB::table('villages')->insert($options);
            }
        }
   }
}


