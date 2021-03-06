<?php

namespace App\Http\Controllers;

use App\Mail\VendorProfileRejectMail;
use App\Mail\VendorProfilResubmitMail;
use App\Models\MerchantProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Geo\Division;
use App\User;
use App\Models\Geo\Village;
use App\Events\SellerRegistration;
use App\Models\Shop;
use App\Models\Reject;
use App\Models\RejectValue;
use App\Mail\VendorProfileApprovalMail;
use App\Mail\VendorProfileAcceptMail;
use Illuminate\Support\Facades\Hash;
use Session;
use Baazar;
class MerchantController extends Controller{

    public function dashboard(){
        $reject_value = RejectValue::all();
        $seller = MerchantProfile::with('rejectvalue')->where('user_id',Auth::user()->id)->first();
        //dd($sellerProfile);
        // $shopProfile = Shop::where('user_id',Auth::user()->id)->first();
       return view('vendor-deshboard',compact('seller','reject_value'));
    }

    public function merchantlogin(){
        return view('auth.merchant.login');
    }
    public function merchantloginprocess(Request $request){
        $credentials = [
            'email'		=> $request->login['email'],
            'password'	=> $request->login['password'],
            'type'	    => 'merchant',
        ];

        // if($request->remember == 'on')
        // 	$user = Auth::attempt($credentials,true);
        // else
        $user = Auth::attempt($credentials);
        // dd($user);
        if($user)
            //return redirect('dashboard');
            // here is redirecing verdor dashboard
            //die('vendoer Dashboard');
            return redirect('merchant/dashboard');
        else
            //die('somer error here...');
            return redirect('merchant/login')->with('error', 'Invalid email or password');
    }




    //Merchant Registration Start HERE........................................................
    public function sellOnAndbaazar(){
        return view('merchant.sell-on-andbaazar');
    }

    public function sellOnAndbaazarPost(Request $request, MerchantProfile $seller){
        $request->merge(['phone' => str_replace('-','',$request->phone)]);
        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'phone'      => 'required|unique:users,phone|min:11|max:11',
            'email'      => 'nullable|unique:users,email',
            'password'   => 'required|min:8'
        ]);
        // dd($request->all());
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'phone'      => $request->phone,
            'password' 	 => Hash::make($request->password),
            'phone_otp'    => mt_rand(10000,99999),
            'verification_token'        => Baazar::randString(24),
            'type'       => 'merchant',
            'create_at'  => now(),
        ]);
        $slug = Baazar::getUniqueSlug($seller,$request->first_name.' '.$request->last_name);

        $merchant = MerchantProfile::create([
            'slug'                  => $slug,
            'reg_step'              => 'otp-varification',
            'user_id'               => $user->id,
            'create_at'             => now(),
        ]);
        flash('Please verify your number')->success()->important();
        return redirect('merchant/otp-varification'.'?token='.$user->verification_token);
    }

    public function getToken(Request $request){
        $seller = User::where('verification_token',$request->token)->firstOrFail();
        if($seller->merchantDetails->reg_step != 'otp-varification'){
            return redirect('merchant/'.$seller->merchantDetails->reg_step.'?token='.$request->token);
        }
        return view('auth.merchant.otp-varification',compact('seller'));

    }

    public function updateToken(Request $request){
        $user    = User::where('verification_token',$request->token)->firstOrFail();
        $user->update([
            'phone_otp' => mt_rand(10000,99999)
        ]);
        // session()->flash('success','Verify toke re-send successfully!');
        return redirect('merchant/otp-varification'.'?token='.$request->token);
    }

    public function postToken(Request $request){
        $request->merge(['phone_otp' => implode("",$request->digit)]);
        $rules = array('phone_otp' => 'required|exists:users,phone_otp|max:5');
        $inputs = array('phone_otp' => $request->phone_otp);
        $validator = \Validator::make($inputs, $rules);
        if($validator->fails()) {
            flash('Invalid OPT')->error()->important();
            return redirect()->back();
        }else{
            $seller = User::where([['phone_otp',$request->phone_otp],['verification_token',$request->token]])->first();
                $seller->update([
                    'phone_otp' => null,
                    'phone_no_verified_at'  => now()
                ]);
                $mer = $seller->merchantDetails;
                $mer->reg_step = 'shop-info';
                $mer->save();
            flash('Please add you shop info')->success()->important();
            return redirect('merchant/shop-info'.'?token='.$request->token);
        }
    }

    // public function personalInfo(Request $request){
    //     $seller = User::where('remember_token',$request->token)->first();
    //     if(!$seller){
    //         return redirect('/');
    //     }
    //     if($seller->reg_step != 'personal-info'){
    //         return redirect('merchant/'.$seller->reg_step.'?token='.$request->token);
    //     }
    //     return view('auth.merchant.personal-info',compact('seller'));
    // }

    // public function savePersonalInfo(Request $request){
    //     $request->validate([
    //         'password'      => 'required|confirmed',
    //         'email'         => 'required|unique:merchants,email',
    //         'agreed'        => 'accepted'
    //     ]);

    //     $seller = User::create([
    //         'first_name' => $request->first_name,
    //         'last_name'  => $request->last_name,
    //         'email'      => $request->email,
    //         'password' 	 => Hash::make($request->password),
    //         'type'       => 'merchant',
    //         'create_at'  => now(),
    //         ]);


    //     $sellerId    = User::where('remember_token',$request->token)->first();
    //     if(!$sellerId){
    //         return redirect('/');
    //     }
    //     $sellerId->update([
    //         'first_name'         => $sellerId->first_name,
    //         'last_name'          => $sellerId->last_name,
    //         'phone'              => $sellerId->phone,
    //         'email'              => $request->email,
    //         'dob'                => $request->dob,
    //         'gender'             => $request->gender,
    //         'description'        => $request->description,
    //         'last_visited_at'    => now(),
    //         'last_visited_from'  => $request->last_visited_from,
    //         'verification_token' => $request->verification_token,
    //         'reg_step'           => 'shop-info',
    //         'status'             => 'Inactive',
    //         'user_id'            =>  $seller->id,
    //         'updated_at'         => now(),
    //     ]);

    //     // \Mail::to($sellerId)->send(new VendorProfileApprovalMail($sellerId));

    //     session()->flash('success','Registration Successfully!');
    //     return redirect('merchant/shop-info'.'?token='.$request->token);
    // }

    public function shopRegistration(Request $request){
        $seller = User::where('verification_token',$request->token)->firstOrFail();
        if($seller->merchantDetails->reg_step != 'shop-info'){
            return redirect('merchant/'.$seller->merchantDetails->reg_step.'?token='.$request->token);
        }

        $divisions = Division::all();

        if($seller->merchantDetails->reg_step != 'shop-info'){
            return redirect('merchant/'.$seller->reg_step.'?token='.$request->token);
        }
        return view('auth.merchant.shop-info',compact('seller','divisions'));
    }

    public function shopRegistrationStore(Request $request,Shop $shop){
        // dd($request->all());

        if($request->new_village){
            $vill = new Village;
            $new_village = Village::create([
                'name'      => $request->new_village,
                'union_id'  => $request->union,
                'slug'      => Baazar::getUniqueSlug($vill,$request->new_village)
            ]);
            $request->merge(['village' => $new_village->id]);
        }

        $request->validate([
            'name'          => 'required',
            'division'      => 'required',
            'district'      => 'required',
            'type'          => 'required',
            'address'       => 'required',
        ]);
        $sellerId = User::where('verification_token',$request->token)->first();
        if(!$sellerId){return redirect('/');}

        $slug = Baazar::getUniqueSlug($shop,$request->name);
        $shop = [
            'name'          => $request->name,
            'slug'          => $slug,
            'lat'           => $request->lat,
            'division_id'   => (int)$request->division,
            'district_id'   => (int)$request->district,
            'lng'           => $request->lng,
            'address'       => $request->address,
            'merchant_id'   => $sellerId->merchantDetails->id,
            'user_id'       => $sellerId->id,
            'create_at'     => now(),
            'type'          => 'none'
        ];
        if($request->type == 'Residential'){
            $agent = Baazar::findAgent($request->type,(int)$request->village);
            $shop = array_merge($shop,[
                    'address_type'  => 'Residential',
                    'upazila_id'    => (int)$request->upazila,
                    'union_id'      => (int)$request->union,
                    'village_id'    => (int)$request->village,
                    'agent_id'      => $agent->id
                ]);
        }else{
            $agent = Baazar::findAgent($request->type,(int)$request->ward);
            $shop =  array_merge($shop,[
                    'address_type'      => 'Municipal',
                    'municipal_id'      => (int)$request->municipal,
                    'municipal_ward_id' => (int)$request->ward,
                    'agent_id'          => $agent->id
                ]);
        }
        Shop::create($shop);
        $sellerId->merchantDetails->update(['reg_step' => 'business-info']);
        flash('Please Select your business area')->success()->important();
        return redirect('merchant/business-info'.'?token='.$request->token);
    }

    public function businessRegistration(Request $request){
        $seller = User::where('verification_token',$request->token)->first();
//        dd($seller->merchantDetails);
        // dd($seller->shop[0]);
        if($seller->merchantDetails->reg_step != 'business-info'){
            return redirect('merchant/'.$seller->merchantDetails->reg_step.'?token='.$request->token);
        }
        $token = $request->token;
        return view('auth.merchant.business-info',compact('token'));
    }

    public function businessRegistrationStore(Request $request){
        if(!$request->business_types){
            flash('invalide business type')->error()->important();
            return redirect()->back();
        }

        $types = $request->business_types;

        $user = User::where('verification_token',$request->token)->first();
        $shop = $user->shop[0];
        $shop->type = $types[0];
        $shop->slug = Baazar::getUniqueSlug($shop,$shop->name.'-'.$types[0]);
        $shop->save();
        array_shift($types);
        foreach($types as $type){
           $new = $shop->replicate();
           $new->type = $type;
           $new->slug =  Baazar::getUniqueSlug($new,$new->name.'-'.$type);
           $new->save();
        }

        // dd($request->business_types);
        // dd($merchant->shop);
        // $user = User::find($merchant->user_id);
        $user->business_types = $request->business_types;
        $user->verification_token = null;
        $user->save();
        $user->merchantDetails->update(['reg_step' => 'complete']);
        flash('Registration success please login')->success()->important();
        return redirect('/login');
    }


    public function termsCondtion(){
        return view('frontend.merchant-termsCondition');
    }
    //Merchant Registration End Here HERE....................................................********************************************************************************....


    private function validateForm($request){
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone'     => 'required',
            'nid'       => 'required|max:10',
        ]);
    }

    public function shopLogoCrop(Request $request){
        $shop   = Shop::find($request->shop);
        if($shop){
            $image_file = $request->image;
            list($type, $image_file) = explode(';', $image_file);
            list(, $image_file)      = explode(',', $image_file);
            $image_file = base64_decode($image_file);
            $image_name= "shop-".$shop->id.'.png';
            $db_img = 'uploads/shops/logos/'.$image_name;
            $path = env('UP_DIR').$db_img;
            file_put_contents($path, $image_file);
            $done = $shop->update(['logo' => $db_img]);
            // session()->forget('logininfo');
            // Session::push('logininfo', $this->sessionData($customer));
            if($done){
                return response()->json(['status'=>true]);
            }
        }
    }

    public function shopBanarCrop(Request $request){
        $shop   = Shop::find($request->shop);
        if($shop){
            $image_file = $request->image;
            list($type, $image_file) = explode(';', $image_file);
            list(, $image_file)      = explode(',', $image_file);
            $image_file = base64_decode($image_file);
            $image_name= "banner-".$shop->id.'.png';
            $db_img = 'uploads/shops/banners/'.$image_name;
            $path = env('UP_DIR').$db_img;
            file_put_contents($path, $image_file);
            $done = $shop->update(['banner' => $db_img]);
            // session()->forget('logininfo');
            // Session::push('logininfo', $this->sessionData($customer));
            if($done){
                return response()->json(['status'=>true]);
            }
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rejectlist = Reject::where('type','profile')->get();

        $activesellers = MerchantProfile::with('shop')->orderBy('id', 'DESC')->get();

        $requestSellers = MerchantProfile::with('shop')->orderBy('id','DESC')->get();

        $rejectSellers = MerchantProfile::with('shop')->orderBy('id','DESC')->get();

        // dd($requestSellers->shop->name);

        return view('merchant.merchant.index',compact('activesellers','requestSellers','rejectSellers','rejectlist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userprofile = Auth::user();
        $sellerProfile = MerchantProfile::where('user_id',Auth::user()->id)->first();
        $shopProfile = Shop::where('user_id',Auth::user()->id)->first();
        if(!empty($sellerProfile))
            return view('merchant.merchant.update',compact('sellerProfile','userprofile','shopProfile'));
        else
            return view('merchant.merchant.create',compact('sellerProfile','userprofile','shopProfile'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, MerchantProfile $seller)
    {
        //dd($request->all());
        $userprofile = Auth::user();
        $sellerId    = MerchantProfile::where('user_id',Auth::user()->id)->first();
        $this->validateForm($request);
        $slug = Baazar::getUniqueSlug($seller,$request->first_name);
        if($sellerId){
            $sellerId->update([
                'first_name'        => $request->first_name,
                'last_name'         => $request->last_name,
                'phone'             => $request->phone,
                'email'             => $request->email,
                // 'picture'           => Baazar::fileUpload($request,'picture','old_image','/uploads/vendor_profile'),
                'dob'               => $request->dob,
                'nid'               => $request->nid,
                'nid_img'           => Baazar::pdfUpload($request,'nid_img','old_nid_img','/uploads/vendor_profile/nid_image'),
                'trad_img'           => Baazar::pdfUpload($request,'trad_img','old_trad_img','/uploads/vendor_profile/trad_image'),
                'gender'            => $request->gender,
                'description'       => $request->description,
                'last_visited_at'   => now(),
                'last_visited_from' => $request->last_visited_from,
                // 'verification_token' => $request->verification_token,
                // 'remember_token' => $request->remember_token,
                'user_id'           => Auth::user()->id,
                'updated_at'        => now(),
            ]);

            $userprofile->update([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'updated_at' => now(),
            ]);

            session()->flash('success','your profile is updated');
            return back();

        }else{
            $sellerId=MerchantProfile::create([
                'first_name'        => $request->first_name,
                'last_name'         => $request->last_name,
                'slug'              => $slug,
                'phone'             => $request->phone,
                'email'             => $request->email,
                // 'picture'           => Baazar::fileUpload($request,'picture','','/uploads/vendor_profile'),
                'dob'               => $request->dob,
                'nid'               => $request->nid,
                'nid_img'           => Baazar::pdfUpload($request,'nid_img','','/uploads/vendor_profile/nid_image'),
                'trad_img'          => Baazar::pdfUpload($request,'trad_img','','/uploads/vendor_profile/trad_image'),
                'gender'            => $request->gender,
                'description'       => $request->description,
                'last_visited_at'   => now(),
                'last_visited_from' => $request->last_visited_from,
                // 'verification_token' => $request->verification_token,
                // 'remember_token' => $request->remember_token,
                'user_id'           => Auth::user()->id,
                'created_at'        => now(),
            ]);

            $userprofile->update([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'updated_at' => now(),
            ]);



            \Mail::to($sellerId)->send(new VendorProfileApprovalMail($sellerId));
            session()->flash('success','Thanks for create profile! Your Message Sent Successfully');
            return back();
        }

        return back();
    }

    public function profileImageCrop(Request $request){
        $profile   = MerchantProfile::find($request->profile);
        if($profile){
            $image_file = $request->picture;
            list($type, $image_file) = explode(';', $image_file);
            list(, $image_file)      = explode(',', $image_file);
            $image_file = base64_decode($image_file);
            $image_name= "profile-".$profile->id.'.png';
            $db_img = 'uploads/vendor_profile'.$image_name;
            $path = public_path($db_img);
            file_put_contents($path, $image_file);
            $done = $profile->update(['picture' => $db_img]);
            // session()->forget('logininfo');
            // Session::push('logininfo', $this->sessionData($customer));
            if($done){
                return response()->json(['status'=>true]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $seller = MerchantProfile::find($id);

        return view('merchant.merchant.show',compact('seller'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $userprofile = Auth::user();
        $seller = MerchantProfile::where('slug',$slug)->first();
        $shopProfile = Shop::where('user_id',Auth::user()->id)->first();
        return view('merchant.merchant.edit',compact('seller','userprofile','shopProfile',''));
    }

    public function update(Request $request, $slug)
    {

        $userprofile = Auth::user();
        $sellerProfile = MerchantProfile::where('slug',$slug)->first();
        $this->validateForm($request);

        $data = [
            'first_name'        => $request->first_name,
            'last_name'         => $request->last_name,
            'phone'             => $request->phone,
            'email'             => $request->email,
            'picture'           => Baazar::fileUpload($request,'picture','old_image','/uploads/vendor_profile'),
            'dob'               => $request->dob,
            'gender'            => $request->gender,
            'description'       => $request->description,
            'last_visited_at'   => now(),
            'last_visited_from' => $request->last_visited_from,
            // 'verification_token' => $request->verification_token,
            // 'remember_token' => $request->remember_token,
            'status'            => 'Inactive',
            'user_id'           => Auth::user()->id,
            'updated_at'        => now(),
        ];

        $sellerProfile->update($data);

        $userprofile->update([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'updated_at' => now(),
        ]);

        $name    = $data['first_name'];
        $surname = $data['last_name'];

        \Mail::to($data['email'])->send(new VendorProfilResubmitMail($data,$name,$surname));

        Session::flash('success', 'Profile Resubmit successfully!');

        return redirect('merchant/merchant');
    }

    public function approvement($id){

        $data = MerchantProfile::where('id',$id)->first();


        $data->update(['status' => 'Active']);
        $name    = $data['first_name'];
        $surname = $data['last_name'];
         \Mail::to($data['email'])->send(new VendorProfileAcceptMail($data,$name,$surname));

        session()->flash('success','Profile Approved Successfully and Sent Mail to the user');

        return back();

    }

    public function rejected(Request $request,$id){
 //dd($request->all());

        $data = MerchantProfile::where('id',$id)->first();
        // dd($data);
        $data->update([
            'status'   => 'Reject',
           ]);

        $rejct_value = RejectValue::where('id',$id)->first();

        $rej_list = count($_POST['rej_name']);

        for($i = 0; $i<$rej_list; $i++){
                $rejct_value=RejectValue::create([
                'rej_name'      => $request->rej_name[$i],
                'type'          => $request->type,
                'merchant_id'   => $data->id,
                'user_id'       => $data->user_id,
            ]);
            // dd($data);
        }
        // $reject = Reject::create([
        //     'rej_name' => $request->rej_name[0],
        //     'user_id'  => Auth::user()->id,
        // ]);

        // $name    = $data['first_name'];
        // $surname = $data['last_name'];
        // $rej_name = $data['rej_name'];
        // \Mail::to($data['email'])->send(new VendorProfileRejectMail($data,$name,$surname,$rej_name));

        session()->flash('warning','Profile Rejected Successfully and Sent Mail to the user');

        return back();

    }

    public function profileDelete($id){
        $merchantProfile = MerchantProfile::find($id);
        $merchantProfile->user()->delete();
        $merchantProfile->delete();
        $merchantProfile->rejectvalue()->delete();
        session()->flash('error','Profile Deleted Successfully');
        return back();
    }

    public function statusUpdate(Request $request,$id){
        // $request->validate([
        //     'yes'        => 'accepted'
        // ]);
        $merchantProfile = MerchantProfile::find($id);
        $merchantProfile->update([
            'status' => 'Inactive',
        ]);

        session()->flash('success','Profile resubmit successfully');

        return back();
    }



    }
