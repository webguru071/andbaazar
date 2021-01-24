<?php

namespace App\Http\Controllers\Api\Customer;
use App\Http\Controllers\Controller;
use App\Models\CustomerAddress;
// use App\User;
use App\Http\Resources\Customer\AddressCollection;
use App\Http\Resources\Customer\AddressResource;
use App\Http\Traits\apiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerAddressController extends Controller{
    use apiTrait;
    public function index(Request $request){
        $user = $request->user();
        dd($user);
        // AddressResource
        
        // CustomerAddress::all();
    }

    public function createAddress(Request $request,CustomerAddress $address){
        $validator = Validator::make($request->all(),[
            'division_id'           => 'required',
            'district_id'           => 'required',
            'zip_code'              => 'required',
            'address'               => 'required',
            'name'                  => 'required',
            'phone'                 => 'required',
            'address_type'          => 'required',
            'is_default_shipping'   => 'required',
            'is_default_billing'    => 'required',
        ]);
        if($validator->fails()){
            return $this->jsonResponse([],$validator->getMessageBag()->first());
        }
        $user = $request->user();
        
        if($request->is_default_shipping === 1){
            CustomerAddress::where('user_id',$user->id)->update(['is_default_shipping'=>0]);
        }
        if($request->is_default_billing === 1){
            CustomerAddress::where('user_id',$user->id)->update(['is_default_billing'=>0]);
        }
        $data = [
            'division_id'         => $request->division_id,
            'district_id'         => $request->district_id,
            'zip_code'            => $request->zip_code,
            'address'             => $request->address,
            'name'                => $request->name,
            'phone'               => $request->phone,
            'address_type'        => $request->address_type,
            'is_default_shipping' => $request->is_default_shipping,
            'is_default_billing'  => $request->is_default_billing,
            'user_id'             => $user->id,
        ];
        $address = CustomerAddress::create($data);
        return $this->jsonResponse(new AddressResource($address),'success',false);
    }
}
