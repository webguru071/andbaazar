<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GeoCollection;
use Illuminate\Http\Request;
use App\Http\Traits\apiTrait;
use App\Models\Geo\Division;
use App\Models\Geo\District;
use App\Models\Geo\Upazila;
use App\Models\Geo\Municipal;
use App\Models\Geo\MunicipalWard;
use App\Models\Geo\Union;
use App\Models\Geo\Village;

class GeoController extends Controller
{
    use apiTrait;
    public function getDivisions(){
        $divisions = Division::all();
        return $this->jsonResponse( new GeoCollection($divisions),'success', false);
    }

    public function getDistricts(Request $request){
        $districts = District::where('division_id',$request->division)->get();
        return $this->jsonResponse( new GeoCollection($districts),'success', false);
    }

    public function getUpazilas(Request $request){
        $districts = Upazila::where('district_id',$request->district)->get();
        return $this->jsonResponse( new GeoCollection($districts),'success', false);
    }
    public function getUnions(Request $request){
        $districts = Union::where('upazila_id',$request->upazila)->get();
        return $this->jsonResponse( new GeoCollection($districts),'success', false);
    }
    public function getVillages(Request $request){
        $districts = Village::where('union_id',$request->union)->get();
        return $this->jsonResponse( new GeoCollection($districts),'success', false);
    }
    public function getMunicipals(Request $request){
        $districts = Municipal::where('district_id',$request->district)->get();
        return $this->jsonResponse( new GeoCollection($districts),'success', false);
    }
    public function getMunicipalsWards(Request $request){
        $districts = MunicipalWard::where('municipal_id',$request->municipal)->get();
        return $this->jsonResponse( new GeoCollection($districts),'success', false);
    }

}
