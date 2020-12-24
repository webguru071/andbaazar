@extends('merchant.master')
@section('content')
@include('elements.alert')

    <!--  dashboard section start -->
<section class="dashboard-section section-b-space">
    <div class="container">
        <div class="row">
            @include('layouts.inc.sidebar.vendor-sidebar',[$active ='shop'])
            <div class="col-sm-9  container">
                <h2 id="heading">Update Shop</h2>
                <form class="theme-form" action="{{route('shopUpdate')}}" method="post" enctype="multipart/form-data" id="validateForm">
                    @csrf
                    <br/>


                    <div class="form-group col-md-12">
                        <div class="row">
                            <input id="searchTextField" type="text" name="address" value="{{$shopProfile->address}}" size="50" placeholder="Enter a location" class="form-control col-md-8 px-10"/>
                            <input type="button" onclick="getLocation();" class="form-control col-md-4 px-10" value="Find my location"/>
                        </div>
                    </div>

                    <input type="hidden" id="lat" name="lat" value="23.811273">
                    <input type="hidden" id="lng" name="lng" value="88.1007585">
                    <div id="map"></div>
                    <br/>


                    <div class="card mb-4">
                        <h5 class="card-header">Enter More Information</h5>
                        <div class="card-body ">
                            <div class="form-group">
                                <select name="division" class="form-control px-10 @error('division') border-danger @enderror" id="division" onchange="getDistrict(this)"  required autocomplete="off" style="height: 45px;">                                         
                                    <option value="">Division</option>
                                    @foreach ($divisions as $division)
                                        <option value="{{$division->id}}" data-lat="{{$division->lat}}" {{$shopProfile->division_id == $division->id ? 'selected' : ''}} data-lng="{{$division->lng}}">{{$division->bn_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="row">
                                    <select name="district" class="form-control col-md-8 px-10 @error('district') border-danger @enderror" id="district"  required autocomplete="off" style="height: 45px;">
                                        <option value="" selected >Select District</option>
                                        @foreach (App\Models\Geo\District::where('division_id',$shopProfile->division_id)->get() as $item)
                                            <option value="{{$item->id}}" {{$shopProfile->district_id == $item->id ? 'selected' : ''}}>{{$item->bn_name}}</option>
                                        @endforeach
                                    </select>
    
                                    <select name="type" class="form-control col-md-4 px-10 @error('type') border-danger @enderror" id="type"  required autocomplete="off" style="height: 45px;">
                                        <option value="Residential" {{$shopProfile->address_type == 'Residential' ? 'selected' : ''}}>Residential</option>
                                        <option value="Municipal"  {{$shopProfile->address_type == 'Municipal' ? 'selected' : ''}}>Municipal</option>
                                    </select>
                                </div>
                            </div>
    
                            <div class="upazila" style="{{$shopProfile->address_type == 'Municipal' ? 'display:none' : ''}}">
                                <div class="form-group">
                                    <select name="upazila" class="form-control px-10 @error('upazila') border-danger @enderror" id="upazila"  required autocomplete="off" style="height: 45px;">
                                        <option value="" selected disabled>Select Upazila</option>
                                        @foreach (App\Models\Geo\Upazila::where('district_id',$shopProfile->district_id)->get() as $item)
                                            <option value="{{$item->id}}" {{$shopProfile->upazila_id == $item->id ? 'selected' : ''}}>{{$item->bn_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="union" class="form-control px-10 @error('union') border-danger @enderror" id="union"  required autocomplete="off" style="height: 45px;">
                                        <option value="" selected disabled>Select Union</option>
                                        @foreach (App\Models\Geo\Union::where('upazila_id',$shopProfile->upazila_id)->get() as $item)
                                            <option value="{{$item->id}}" {{$shopProfile->union_id == $item->id ? 'selected' : ''}}>{{$item->bn_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="village" class="form-control px-10 @error('village') border-danger @enderror" id="village"  required autocomplete="off" style="height: 45px;">
                                        <option value="" selected disabled>Select Village</option>
                                        @foreach (App\Models\Geo\Village::where('union_id',$shopProfile->union_id)->get() as $item)
                                            <option value="{{$item->id}}" {{$shopProfile->village_id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
    
                            <div class="municipal" style="{{$shopProfile->address_type == 'Residential' ? 'display:none' : ''}}">
                                <div class="form-group">
                                    <select name="municipal" class="form-control px-10 @error('municipal') border-danger @enderror" id="municipal"  required autocomplete="off" style="height: 45px;">
                                        <option value="" selected disabled>Select municipal</option>
                                        @foreach (App\Models\Geo\Municipal::where('district_id',$shopProfile->district_id)->get() as $item)
                                            <option value="{{$item->id}}" {{$shopProfile->municipal_id == $item->id ? 'selected' : ''}}>{{$item->bn_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="ward" class="form-control px-10 @error('ward') border-danger @enderror" id="ward"  required autocomplete="off" style="height: 45px;">
                                        <option value="" selected disabled>Select ward</option>
                                        @foreach (App\Models\Geo\MunicipalWard::where('municipal_id',$shopProfile->municipal_id)->get() as $item)
                                            <option value="{{$item->id}}" {{$shopProfile->municipal_ward_id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card mb-4">
                        <h5 class="card-header">Enter More Information</h5>
                        <div class="card-body ">
                         <div class="row">
                            <div class="form-group  col-md-6">
                                <label for="name" >Shop Name <span class="text-danger"> *</span></label>
                                <input type="text" class="form-control " @error('name') border-danger @enderror" required name="name" value="{{ old('name',$shopProfile->name) }}" id="name" placeholder="Shop Name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="slogan">Shop slogan</label>
                                <input type="text" class="form-control  @error('slogan') border-danger @enderror"  name="slogan" value="{{ old('slogan',$shopProfile->slogan) }}" id="slogan" placeholder="Shop slogan" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone" >Shop Phone <span class="text-danger"> *</span></label>
                                <input type="text" class="form-control  @error('phone') border-danger @enderror" required  name="phone" value="{{ old('phone',$shopProfile->phone) }}" id="phone" placeholder="Shop Phone" />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email" >Shop Email</label>
                                <input type="email" class="form-control  @error('email') border-danger @enderror" name="email" value="{{ old('email',$shopProfile->email) }}" id="email" placeholder="Shop Email" />
                            </div>
                            </div>
                            <div class="form-group ">
                                <label for="url">Shop Web Address</label>
                                <input type="url" class="form-control col-md-12 @error('web') border-danger @enderror" name="web" value="{{ old('Web',$shopProfile->web) }}" id="url" placeholder="Shop website" />
                            </div>

                            <div class="form-group">
                                <label for="en_description" class="">Write about your shop (English)<span class="text-danger"> *</span></label>
                                <textarea class="form-control summernote @error('description') border-danger @enderror" placeholder="Write Your Message" name="description" id="en_description" rows="15">{{ $shopProfile->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="bn_description" class="">Write about your shop (Bangla)<span class="text-danger"> *</span></label>
                                <textarea class="form-control summernote @error('bdesc') border-danger @enderror" placeholder="Write Your Message"  name="bdesc"  id="bn_description" rows="15" >{{ $shopProfile->bdesc }}</textarea>
                            </div>

                        </div>
                    </div>
                    <div class="card mb-4">
                        <h5 class="card-header">Enter Your Own Link</h5>
                        <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name" >Facebook</label>
                                <input type="url" class="form-control @error('facebook') border-danger @enderror" name="facebook" value="{{ old('Web',$shopProfile->facebook) }}" id="" placeholder="Own Profile ID " />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="slogan">Twitter (Optional)</label>
                                <input type="url" class="form-control  @error('twitter') border-danger @enderror" name="twitter" value="{{ old('Web',$shopProfile->twitter) }}" id="" placeholder="Own Profile ID " />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="slogan">Instagram (Optional)</label>
                                <input type="url" class="form-control  @error('instagram') border-danger @enderror" name="instagram" value="{{ old('Web',$shopProfile->instagram) }}" id="" placeholder="Own Profile ID " />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="slogan" >Youtube (Optional)</label>
                                <input type="url" class="form-control @error('youtube') border-danger @enderror" name="youtube" value="{{ old('Web',$shopProfile->youtube) }}" id="" placeholder="Own Profile ID " />
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="form-group text-right mt-2">
                        <button type="submit" class="btn btn-sm btn-solid">Shop Update</button>
                    </div>
                </form>
            </div>
      </div>
</section>
@endsection


@push('css')
<style>
    /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */
    #maps {
      height: 400px;
    }
    /* Optional: Makes the sample page fill the window. */
  </style>
@endpush

@push('js')
@include('elements.map',['lat' => $shopProfile->lat,'lng' => $shopProfile->lng])
{{-- <script>

var marker;
    function initMap(l=23.811273,g=90.404240,z=6) {
    var latlng = new google.maps.LatLng( {{ $shop->lat }}, {{ $shop->lng }});
      var map = new google.maps.Map(document.getElementById('maps'), {
        zoom: z,
        center: latlng,//{lat: 23.811273, lng: 90.404240}
      });
      // var image = 'http://localhost/andbaazar/public/frontend/assets/images/icon/logo.png';
      marker = new google.maps.Marker({
        map: map,
        draggable: true,
        animation: google.maps.Animation.DROP,
        position: latlng,
        title: 'Dhaka'
        // icon: image
      });
      marker.addListener('dragend', latLngs);
    }
    function latLngs() {
        $('#lat').val(marker.position.lat());
        $('#lng').val(marker.position.lng());
    }
  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtygZ5JPTLgwFLA8nU6bb4d_6SSLlTPGw&callback=initMap">
  </script> --}}
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $('#district').change(function(){
        var district = $(this).find('option:selected'); 
        var lat = district.data("lat"); 
        var lng = district.data("lng");
        $.ajax({
            url : "{{route('get-upazila')}}",
            type : 'POST',
            data : {'district':$(this).val(),'_token':'{{csrf_token()}}'},
            dataType : 'json',
            beforeSend : function(){
                console.log('sending');
            },
            success : function(response){
                $('#upazila').html(response.upazila);
                $('#municipal').html(response.municipal);
            }
        });
        // initMap(lat,lng,10);
        $('#union').html('<option value="" selected disabled>Select Union</option>');
        $('#village').html('<option value="" selected disabled>Select Village</option>');
        $('#ward').html('<option value="" selected disabled>Select ward</option>');
    });

    function getDistrict(e){
        var division = $(e).find('option:selected'); 
        var lat = division.data("lat"); 
        var lng = division.data("lng");
        $.ajax({
            url : "{{route('get-district')}}",
            type : 'POST',
            data : {'division':$(e).val(),'_token':'{{csrf_token()}}'},
            dataType : 'text',
            beforeSend : function(){
                console.log('sending');
            },
            success : function(response){
                // console.log(response);
                $('#district').html(response);
            }
        });
        // initMap(lat,lng,10);
        $('#upazila').html('<option value="" selected disabled>Select Upazila</option>');
        $('#union').html('<option value="" selected disabled>Select Union</option>');
        $('#village').html('<option value="" selected disabled>Select Village</option>');
        $('#municipal').html('<option value="" selected disabled>Select Municipal</option>');
        $('#ward').html('<option value="" selected disabled>Select ward</option>');
    };

    $('#upazila').change(function(){
        // var upazila = $(this).find('option:selected'); 
        // var lat = upazila.data("lat"); 
        // var lng = upazila.data("lng");
        $.ajax({
            url : "{{route('get-union')}}",
            type : 'POST',
            data : {'upazila':$(this).val(),'_token':'{{csrf_token()}}'},
            dataType : 'text',
            beforeSend : function(){
                console.log('sending');
            },
            success : function(response){
                // console.log(response);
                $('#union').html(response);
            }
        });
        $('#village').html('<option value="" selected disabled>Select Village</option>');
        // initMap(lat,lng,10);
    });

    $('#municipal').change(function(){
        // var upazila = $(this).find('option:selected'); 
        // var lat = upazila.data("lat"); 
        // var lng = upazila.data("lng");
        $.ajax({
            url : "{{route('get-ward')}}",
            type : 'POST',
            data : {'municipal':$(this).val(),'_token':'{{csrf_token()}}'},
            dataType : 'text',
            beforeSend : function(){
                console.log('sending');
            },
            success : function(response){
                // console.log(response);
                $('#ward').html(response);
            }
        });
        // initMap(lat,lng,10);
    });

    $('#union').change(function(){
        // var upazila = $(this).find('option:selected'); 
        // var lat = upazila.data("lat"); 
        // var lng = upazila.data("lng");
        $.ajax({
            url : "{{route('get-village')}}",
            type : 'POST',
            data : {'union':$(this).val(),'_token':'{{csrf_token()}}'},
            dataType : 'text',
            beforeSend : function(){
                console.log('sending');
            },
            success : function(response){
                // console.log(response);
                $('#village').html(response);
            }
        });
        // initMap(lat,lng,10);
    });

    $('#type').change(function(){
        var type = $(this).val();
        // console.log(type);
        if(type == 'Municipal'){
            $('.municipal').show();
            $('.upazila').hide();
        }else{
            $('.municipal').hide();
            $('.upazila').show();
        }
    });


    $(document).ready(function() {
     $('.summernote').summernote({
           height: 300,
      });
   });
    $('.js-example-basic-multiple').select2();
 </script>
@endpush
