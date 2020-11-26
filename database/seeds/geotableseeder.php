<?php

use Illuminate\Database\Seeder;
use App\Helpers\Baazar;
use App\Models\Union;
class geotableseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        include('geo/divisions.php');
        include('geo/districts.php');
        include('geo/upazilas.php');
        include('geo/unions.php');
        include('geo/municipals.php');
        include('geo/villages.php');


        //division data
        $divisionData = [];
        foreach($divisions as $division){
            $divisionData[] = [
                'id'            => $division['id'],
                'name'          => $division['name'],
                'bn_name'       => $division['bn_name'],
                'slug'          => Str::slug($division['name']),
                'url'           => $division['url'],
                'lat'           => $division['lat'],
                'lng'           => $division['lng'],
                'created_at'    => now()
            ];
        }
        \DB::table('divisions')->insert($divisionData);
        echo 'Division Inserted! --';

        //district data
        $districtData = [];
        foreach($districts as $district){
            $districtData[] = [
                'id'            => $district['id'],
                'division_id'   => $district['division_id'],
                'name'          => $district['name'],
                'bn_name'       => $district['bn_name'],
                'slug'          => Str::slug($district['name']),
                'url'           => $district['url'],
                'lat'           => $district['lat'],
                'lng'           => $district['lon'],
                'created_at'    => now()
            ];
        }
        \DB::table('districts')->insert($districtData);
        echo 'District Inserted! --';

        //upazila data
        $upazilaData = [];
        foreach($upazilas as $upazila){
            $upazilaData[] = [
                'id'            => $upazila['id'],
                'district_id'   => $upazila['district_id'],
                'name'          => $upazila['name'],
                'bn_name'       => $upazila['bn_name'],
                'slug'          => Str::slug($upazila['name']),
                'url'           => $upazila['url'],
                'created_at'    => now()
            ];
        }
        \DB::table('upazilas')->insert($upazilaData);
        echo 'Upazila Inserted! --';


        //Union data
        $unionModel = new Union;
        $baazar = new Baazar;
        $unionData = [];
        foreach($unions as $union){
            $unionData[] = [
                'id'            => $union['id'],
                'upazila_id'    => $union['upazilla_id'],
                'name'          => $union['name'],
                'bn_name'       => $union['bn_name'],
                'slug'          => isset($union['slug']) ? $union['slug'] :$baazar->getUniqueSlug($unionModel,$union['name']),
                'url'           => $union['url'],
                'created_at'    => now()
            ];
        }
        \DB::table('unions')->insert($unionData);
        echo 'Union Inserted!';

        //Union data
        $villageData = [];
        foreach($villages as $village){
            $villageData[] = [
                'union_id'      => $village['union_id'],
                'name'          => $village['name'],
                'bn_name'       => $village['bn_name'],
                'slug'          => Str::slug($village['name']),
                'created_at'    => now()
            ];
        }
        \DB::table('villages')->insert($villageData);
        echo 'Village Inserted!';




        //Municipal data
        foreach($municipals as $municipal){
            $municipalData = [
                'district_id'   => $municipal['district_id'],
                'name'          => $municipal['name'],
                'bn_name'       => $municipal['bn_name'],
                'slug'          => Str::slug($municipal['name']),
                'created_at'    => now()
            ];
            $newM = App\Models\Geo\Municipal::create($municipalData);
            $wardData = [];
            for($i=1; $i<=$municipal['ward'];$i++){
                $wardData[] = [
                    'name'          => 'Ward-'.$i,
                    'municipal_id'  => $newM->id,
                ];
            }
            \DB::table('municipal_wards')->insert($wardData);
        }
        echo 'Municipal Inserted!';
    }
}
