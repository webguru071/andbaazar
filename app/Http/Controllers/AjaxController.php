<?php

namespace App\Http\Controllers;
use App\Models\Geo\Division;
use App\Models\Geo\District;
use App\Models\Geo\Upazila;
use App\Models\Geo\Municipal;
use App\Models\Geo\Union;
use Illuminate\Http\Request;
use App\Models\Inventory;

class AjaxController extends Controller
{
    public function getDistrict(Request $request){
        // echo $request->division;
        $division = Division::with('district')->find($request->division);
        $options = '<option value="" selected disabled>Select District</option>';

        foreach($division->district as $row){
        //    dd($row->upazila);
            $options .= "<option value='{$row->id}' data-lat='{$row->lat}' data-lng='{$row->lng}'>{$row->bn_name}</option>";
        }
        if(empty($options)){
            $options .= '<option value="" selected disabled>District not found</option>';
        }
        echo $options;
    }

    public function getUpazila(Request $request){
        $district = District::with('upazila','municipal')->find($request->district);
        $options = '<option value="" selected disabled>Select Upazila</option>';
        $municipals = '<option value="" selected disabled>Select municipal</option>';

        foreach($district->municipal as $row){
            $municipals .= "<option value='{$row->id}'>{$row->bn_name}</option>";
        }
        if(empty($municipals)){
            $municipals .= '<option value="" selected disabled>Municipal not found</option>';
        }

        foreach($district->upazila as $row){
            $options .= "<option value='{$row->id}'>{$row->bn_name}</option>";
        }
        if(empty($options)){
            $options .= '<option value="" selected disabled>Upazila not found</option>';
        }
        echo json_encode(['upazila' => $options,'municipal' => $municipals]);
    }

    public function getUnion(Request $request){
        $upazila = Upazila::with('union')->find($request->upazila);
        $options = '<option value="" selected disabled>Select Union</option>';
        foreach($upazila->union as $row){
            $options .= "<option value='{$row->id}'>{$row->bn_name}</option>";
        }
        if(empty($options)){
            $options .= '<option value="" selected disabled>Union not found</option>';
        }
        echo $options;
    }

    public function getVillage(Request $request){
        $unions = Union::with('village')->find($request->union);
        $options = '<option value="" selected disabled>Select Village</option><option value="new">Add your village name</option>';
        foreach($unions->village as $row){
            $options .= "<option value='{$row->id}'>{$row->name}</option>";
        }
        if(empty($options)){
            $options .= '<option value="" selected disabled>Village not found</option>';
        }
        echo $options;
    }

    public function getWard(Request $request){
        $municipal = Municipal::with('wards')->find($request->municipal);
        $options = '<option value="" selected disabled>Select ward</option>';
        foreach($municipal->wards as $row){
            $options .= "<option value='{$row->id}'>{$row->name}</option>";
        }
        if(empty($options)){
            $options .= '<option value="" selected disabled>Ward not found</option>';
        }
        echo $options;
    }

    

     public function searchColorWiseInventory($invnent_id){
        if($invnent_id == 0){
            $inventories  = Inventory::all();
         }else{
            $inventories  = Inventory::where('color_id',$invnent_id)->get(); 
         }
         $html = '';
         if(!empty($inventories)){ 
             foreach($inventories as $inventorie){
                $html .= "<tr>"; 
                $html .= "<td>{$inventorie->color->name}</td>";
                $html .= "<td>{$inventorie->item->name}</td>";
                $html .= "<td>{$inventorie->price}</td>";
                $html .= "<td>{$inventorie->qty_stock}</td>";
                $html .= "<td>2000</td>";
                $html .= "<td class=''>
                            <ul>
                                <li><a  ><button class='btn btn-sm btn-warning' ><i class='fa fa-edit'></i> </button></a></li>
                                <li>
                                <form  method='post' style='margin-top:-2px' id='deleteButton{{$inventorie->id}}'>
                                @csrf
                                @method('delete')
                                <button type='submit' class='btn btn-sm btn-primary' onclick='sweetalertDelete({{$inventorie->id}})'><i class='fa fa-trash-o'></i></button>
                            </form>
                                </li>
                            </ul>
                        </td>";
                $html .= "</tr>";
              }
             }else{
                $html .= "<tr>";
                $html .= "<td colspan='2'>No data</td>";
                $html .= "</tr>";
             }
             echo $html;
         }
     
}
